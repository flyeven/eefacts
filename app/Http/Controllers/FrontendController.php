<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Draw;
use App\Post;
use App\Tag;
use App\Comment;

class FrontendController extends Controller
{
    //draws and posts info variables 
    protected $lastPosts;
    protected $allPosts;
    protected $lastDraw;
    protected $allDraws;

    public function __construct()
    {
        //SET draws and posts info variables 
        $this->lastPosts  = Post::where('status', 1)
                            ->where('type', 1)
                            ->whereNotNull('published_at')
                            ->where('published_at', '<=', date('Y-m-d H:i:s'))
                            ->orderBy('published_at', 'desc')
                            ->take(env('NEWS_QUICK_PREVIEW', 3))
                            ->get();

        $this->allPosts = Post::where('status', 1)
                            ->where('type', 1)
                            ->whereNotNull('published_at')
                            ->where('published_at', '<=', date('Y-m-d H:i:s'))
                            ->orderBy('published_at', 'desc')
                            ->paginate(env('NEWS_PER_PAGE', 5));

        $this->lastDraw = Draw::where('status', 1)->orderBy('valid_at', 'desc')->first();

        $this->allDraws = Draw::where('status', 1)->orderBy('valid_at', 'desc')->get();

    }

    /**
     * Show homepage
     */
    public function getHomePage(){
    	
        return view('front.home')
    				->with('lastDraw', $this->lastDraw)
    				->with('allDraws', $this->allDraws)
                    ->with('lastPosts', $this->lastPosts);
    }

    /**
     * Redirect to homepage
     */
    public function redirectToHomePage(){
        return redirect('/');
    }

    /**
     * Show About page
     */
    public function getAboutPage(){
    	return view('front.about')
    			->with('lastDraw', $this->lastDraw)
    			->with('allDraws', $this->allDraws)
                ->with('lastPosts', $this->lastPosts);
    }

    /**
     * Show Useful Info page
     */
    public function getUsefulPage(){
        return view('front.useful')
                ->with('lastDraw', $this->lastDraw)
                ->with('allDraws', $this->allDraws)
                ->with('lastPosts', $this->lastPosts);
    }

    /**
     * Show News posts page
     */
    public function getNewsPage(){      
        return view('front.news')
                ->with('lastDraw',  $this->lastDraw)
                ->with('allDraws',  $this->allDraws)
                ->with('allPosts',  $this->allPosts)
                ->with('lastPosts', $this->lastPosts);
    }

    /**
     * Show posts filtered by Tag page
     */
    public function getPostsListByTagPage($tagName){
        $tag = Tag::where('name', $tagName)->first();
        if($tag){
            $posts = $tag->posts()
                    ->where('status', 1)
                    ->where('type', 1)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', date('Y-m-d H:i:s'))
                    ->orderBy('published_at', 'desc')
                    ->paginate(env('NEWS_PER_PAGE', 5));
                    
            return view('front.tags')
                ->with('lastDraw', $this->lastDraw)
                ->with('allDraws', $this->allDraws)
                ->with('allPosts', $posts)
                ->with('lastPosts', $this->lastPosts)
                ->with('tagName', $tagName);
        }else{
            return redirect('/');
        }
        
        
    }

    /**
     * Show post page
     */
    public function getPostBySlugPage($slug){
        $post = Post::where('slug', $slug)
                    ->where('status', 1)
                    ->where('type', 1)
                    ->whereNotNull('published_at')
                    ->where('published_at', '<=', date('Y-m-d H:i:s'))
                    ->first();
        if($post){
            return view('front.post')
                    ->with('lastDraw', $this->lastDraw)
                    ->with('allDraws', $this->allDraws)
                    ->with('lastPosts', $this->lastPosts)
                    ->with('post', $post);
        }else{
            return redirect('/news');
        }
    }

    /**
     * Process CommentRequest to add a new comment to db
     */
    public function postAddPostComment(CommentRequest $request){
        if($request->has('post-id')){
            $post = Post::find($request->get('post-id'));
            if($post){
                $newComment = new Comment;
                $newComment->post_id = $request->get('post-id');
                $newComment->visitor_name = $request->get('name');
                $newComment->visitor_email = $request->get('email');
                $newComment->visitor_message = $request->get('message');
                $newComment->save();
                return redirect('/news/'.$post->slug.'#comments');
            }else{
                return redirect('/news');
            }
        }else{
            return redirect('/news');
        }
    }

    /**
     * Gather all statistical data needed and show it on Stats page
     */    
    public function getStatsPage(){
    	$lastDraw = Draw::where('status', 1)->orderBy('valid_at', 'desc')->first();
    	$firstDraw = Draw::where('status', 1)->orderBy('valid_at', 'asc')->first();
    	$allDraws = Draw::where('status', 1)->orderBy('valid_at', 'desc')->get();
    	$stats = array();
    	
    	$todayTime = strtotime(date("Y-m-d"));
    	$firstTime = strtotime($firstDraw->valid_at);

    	$todayYear = date('Y', $todayTime);
    	$firstYear = date('Y', $firstTime);

    	$todayMonth= date('m', $todayTime);
		$firstMonth = date('m', $firstTime);

		$countMonths = (($todayYear - $firstYear) * 12) + ($todayMonth - $firstMonth);

    	$stats['cntrnds'] = $allDraws->count();
    	$stats['avginvmth'] = $stats['cntrnds'] / $countMonths;
		$stats['cntinvs'] = $allDraws->sum('invitations');    	
		$stats['mincrs'] = $allDraws->min('score');
		$stats['maxcrs'] = $allDraws->max('score');
		$stats['avgcrs'] = $allDraws->avg('score');
		$stats['maxinv'] = $allDraws->max('invitations');
		$stats['mininv'] = $allDraws->min('invitations');
		$stats['avginv'] = $allDraws->avg('invitations');

		$stats['shortint'] = 365*10;
		$stats['longint'] = 0;

        //computing the shortest&longest interval between two draws
		foreach($allDraws as $idx => $draw){
			if($idx == 0){
				$lastTime = strtotime($draw->valid_at);
			} else {
				$daysdiff = ($lastTime - strtotime($draw->valid_at))/60/60/24;
				if($daysdiff < $stats['shortint']) {
					$stats['shortint'] = $daysdiff;
				}
				if($daysdiff > $stats['longint']) {
					$stats['longint'] = $daysdiff;
				}
				$lastTime = strtotime($draw->valid_at);
			}
		}

    	return view('front.stats')
    			->with('lastDraw', $this->lastDraw)
    			->with('allDraws', $this->allDraws)
                ->with('lastPosts', $this->lastPosts)
    			->with('stats', $stats);
    }

    /**
     * Show Reports page
     */
    public function getReportsPage(){
        return view('front.reports')
                ->with('lastDraw', $this->lastDraw)
                ->with('allDraws', $this->allDraws)
                ->with('lastPosts', $this->lastPosts);
    }


}
