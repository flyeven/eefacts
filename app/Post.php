<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;


class Post extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
        'save_to'    => 'slug',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function getPictureAttribute($value)
    {
        if(!$value){
            return env('DUMMY_POST_IMAGE', 'http://dummyimage.com/840x341/ff0000/fff.png&text=EE+news');
        }else{
            return str_replace(public_path(),'',$value);
        }
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function tagsList()
    {
    	$tags = $this->tags()->get();
    	$tagsList = '';
    	foreach($tags as $tag){
    		$tagsList .= $tag->name.' ';
    	}
    	return $tagsList;
    }

    public function updateTags($tagsList)
    {
    	$finalTags = explode(' ', strtolower($tagsList));
    	$existingTags = explode(' ', $this->tagsList());

    	$detachTags = array_unique(array_diff($existingTags, $finalTags));
    	$attachTags = array_unique(array_diff($finalTags, $existingTags));

    	foreach ($attachTags as $tag) {
            $exist = Tag::where('name', $tag)->first();
            if(!$exist){
                $newTag = new Tag;
                $newTag->name = $tag;
                $newTag->save();
                $this->tags()->attach($newTag->id);
            }else{
                $this->tags()->attach($exist->id);
            }
        }

        foreach ($detachTags as $tag) {
        	$exist = Tag::where('name', $tag)->first();
            if($exist){
                $this->tags()->detach($exist->id);
            }
        }
    }

    public function detachAllTags(){
    	foreach ($this->tags()->get() as $tag) {
    		$this->tags()->detach($tag->id);
    	}
    }
}
