<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NewPostRequest;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Event;
use App\Events\UpdateSitemap;

class PostsController extends Controller
{
    /**
     * Show Posts page
     */
    public function getPostsPage(){
    	$posts = Post::where('status', 1)->orderBy('created_at', 'desc')->get();
    	return view('back.posts.table')->with('posts', $posts);
    }

    /**
     * Show Add new post page
     */
    public function getNewPostPage(){
    	return view('back.posts.add');
    }

    /**
     * Process NewPostRequest from the new post page
     */
    public function postNewPost(NewPostRequest $request){
    	
    	$type = 1;

    	$newPost = new Post;
    	$newPost->title = $request->get('title');
        $newPost->text = $request->get('text');
        if($request->has('publisheddate')){
            $newPost->published_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('publisheddate').' '.$request->get('publishedtime'))));
        }
    	$newPost->type = $type;
    	$newPost->status = 1;

    	$newPost->save();

        if($request->has('tags')) {
            $newPost->updateTags($request->get('tags'));
        }

        if ($request->hasFile('picture') && $request->file('picture')->isValid())
        {
            $imageName = 'eefacts-p'.$newPost->id . '.' . $request->file('picture')->getClientOriginalExtension();
            $request->file('picture')->move( base_path() . '/public/images/post-images/', $imageName );
            $newPost->picture = base_path() . '/public/images/post-images/'.$imageName;
            $newPost->save();
        }
        Event::fire(new UpdateSitemap());
    	return redirect('admin/posts')->with('status','New post added successfully!');
    }

    /**
     * Process NewPostRequest from the edit post page
    */
    public function postEditPost(NewPostRequest $request){
    	
    	   
    	$changedPost = Post::find($request->get('id'));

    	if($changedPost){

	    	$changedPost->title = $request->get('title');
            $changedPost->text = $request->get('text');
            if($request->has('publisheddate')){
	    	  $changedPost->published_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('publisheddate').' '.$request->get('publishedtime'))));
            }

	    	$changedPost->save();
            if($request->has('tags')) {
                $changedPost->updateTags($request->get('tags'));
            }else{
                $changedPost->detachAllTags();
            }

            if ($request->hasFile('picture') && $request->file('picture')->isValid())
            {
                
                $imageName = 'eefacts-p'.$changedPost->id . '.' . $request->file('picture')->getClientOriginalExtension();
                $request->file('picture')->move( base_path() . '/public/images/post-images/', $imageName );
                $changedPost->picture = base_path() . '/public/images/post-images/'.$imageName;
                $changedPost->save();
            }

            $changedPost->resluggify()->save();

            Event::fire(new UpdateSitemap());
	    	return redirect('admin/posts')->with('status','Post successfully saved!');
	    }else{
	    	return redirect('admin/posts');
	    }
    }

    /**
     * Show edit post page
    */
    public function getEditPostPage($id){
    	$post = Post::find($id);
    	if($post){
    		return view('back.posts.edit')->with('post', $post);
    	} else {
    		return redirect('admin/posts');
    	}
    }

    /**
     * Show delete post page
    */
    public function getDeletePostPage($id){
    	$post = Post::find($id);
    	if($post){
    		return view('back.posts.delete')->with('post', $post);
    	} else {
    		return redirect('admin/posts');
    	}
    }

    /**
     * Process delete post request
    */
    public function postDeletePost(Request $request){
    	$post = Post::find($request->get('id'));
    	if($post){
    		$post->delete();
            Event::fire(new UpdateSitemap());
    		return redirect('admin/posts')->with('status','Post successfully deleted!');
    	} else {
    		return redirect('admin/posts');
    	}
    }

}
