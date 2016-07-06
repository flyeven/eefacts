<?php

namespace App\Listeners;

use App\Events\UpdateSitemap;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use URL;
use App\Draw;
use App\Post;
use App\Tag;
use DB;
use File;

class EventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UpdateSitemap  $event
     * @return void
     */
    public function handle(UpdateSitemap $event)
    {   
        $lastDrawTime = strtotime(Draw::where('status', 1)->orderBy('valid_at', 'desc')->first()->created_at);
        $lastmodDraw = date('c', $lastDrawTime);

        $lastPostTime = strtotime(Post::where('status', 1)->where('type', 1)->whereNotNull('published_at')->orderBy('published_at', 'desc')->first()->created_at);
        $lastmodPost = date('c', $lastPostTime);

        $lastAppTime = ($lastDrawTime > $lastPostTime ) ? $lastDrawTime :$lastPostTime;
        $lastmodApp = date('c', $lastAppTime);

        $sitemap = \App::make("sitemap");
        $sitemap->add(URL::to('/'), $lastmodApp, '1.0', 'daily');
        $sitemap->add(URL::to('/reports'), $lastmodDraw, '1.0', 'monthly');
        $sitemap->add(URL::to('/about'), $lastmodDraw, '1.0', 'monthly');
        $sitemap->add(URL::to('/stats'), $lastmodDraw, '1.0', 'weekly');
        $sitemap->add(URL::to('/news'), $lastmodPost, '1.0', 'daily');
        $sitemap->add(URL::to('/useful'), $lastmodPost, '1.0', 'weekly');
        
        $allPosts = Post::where('status', 1)->where('type', 1)->whereNotNull('published_at')->orderBy('created_at', 'desc')->get();
        foreach($allPosts as $post){
            $thisPostTime = strtotime($post->published_at);
            $lastmodThis = date('c', $thisPostTime);
            $sitemap->add(URL::to('/news/'.$post->slug), $lastmodThis, '0.9', 'monthly');
        }

        $allTags = Tag::all();
        foreach($allTags as $tag){
            $lastTagUse = DB::table('post_tag')->where('tag_id', $tag->id)->orderBy('updated_at', 'desc')->first();
            if($lastTagUse){
                $thisTagTime = strtotime($lastTagUse->updated_at);
                $lastmodThis = date('c', $thisTagTime);
                $sitemap->add(URL::to('/tag/'.$tag->name), $lastmodThis, '0.9', 'daily');
            }  
        }

        $sitemap->store('xml','sitemap');

        $sitemapUrl = url('/sitemap.xml');
        
        $enginesPing = '';

        //Google
        $url = "http://www.google.com/webmasters/sitemaps/ping?sitemap=".$sitemapUrl;
        $returnCode = $this->exeCurl($url);
        $enginesPing .= date("Y-m-d H:i:s")." => Google Sitemaps has been pinged (return code: $returnCode)."."\r\n";

        //Bing / MSN
        $url = "http://www.bing.com/webmaster/ping.aspx?siteMap=".$sitemapUrl;
        $returnCode = $this->exeCurl($url);
        $enginesPing .= date("Y-m-d H:i:s")." => Bing / MSN Sitemaps has been pinged (return code: $returnCode)."."\r\n";

        //ASK
        $url = "http://submissions.ask.com/ping?sitemap=".$sitemapUrl;
        $returnCode = $this->exeCurl($url);
        $enginesPing .= date("Y-m-d H:i:s")." => ASK.com Sitemaps has been pinged (return code: $returnCode)."."\r\n";

        if (!File::exists('search-engines-ping.log')){
            File::put('search-engines-ping.log', $enginesPing);
        }else{
            File::append('search-engines-ping.log', $enginesPing);
        }
        return true;
    }

    private function exeCurl($url){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $httpCode;
    }
}
