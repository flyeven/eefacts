<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\NewDrawRequest;
use App\Http\Controllers\Controller;
use Event;
use App\Events\UpdateSitemap;
use App\Draw;

class DrawsController extends Controller
{
    /**
     * Show manage rounds of invitations page
     */
    public function getDrawsPage(){
    	$draws = Draw::where('status', 1)->orderBy('valid_at', 'desc')->get();
    	return view('back.draws.table')->with('draws', $draws);
    }

    /**
     * Show Add new round of invitations page
     */
    public function getNewDrawPage(){
    	return view('back.draws.add');
    }

    /**
     * Process NewDrawRequest from Add new round of invitations page
     */
    public function postNewDraw(NewDrawRequest $request){
    	
    	//set draw type according to stream checkboxes checked
        $type = 1;

    	if($request->has('fswp') ){
    		$type *= 2;
    	}

    	if($request->has('fstp') ){
    		$type *= 3;
    	}

    	if($request->has('cec') ){
    		$type *= 5;
    	}

    	if($request->has('pnp') ){
    		$type *= 7;
    	}

    	$newDraw = new Draw;

    	$newDraw->number = $request->get('number');
    	$newDraw->drawn_at = date("Y-m-d", strtotime(str_replace('/', '-', $request->get('refdate'))));
    	$newDraw->valid_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('refdate').' '.$request->get('reftime'))));
    	$newDraw->start_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('startissue'))));
    	$newDraw->end_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('endissue'))));
    	$newDraw->score = $request->get('score');
    	$newDraw->invitations = $request->get('invitations');
    	$newDraw->type = $type;
    	$newDraw->status = 1;

    	$newDraw->save();

        //update Sitemap after new draw was saved
        Event::fire(new UpdateSitemap());

    	return redirect('admin/draws')->with('status','New round of invitations added successfully!');
    }

    /**
     * Process NewDrawRequest from Edit round of invitations page
     */
    public function postEditDraw(NewDrawRequest $request){
    	//set draw type according to stream checkboxes checked
    	$type = 1;

    	if($request->has('fswp') ){
    		$type *= 2;
    	}

    	if($request->has('fstp') ){
    		$type *= 3;
    	}

    	if($request->has('cec') ){
    		$type *= 5;
    	}

    	if($request->has('pnp') ){
    		$type *= 7;
    	}

    	$changedDraw = Draw::find($request->get('id'));

    	if($changedDraw){
	    	$changedDraw->number = $request->get('number');
	    	$changedDraw->drawn_at = date("Y-m-d", strtotime(str_replace('/', '-', $request->get('refdate'))));
	    	$changedDraw->valid_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('refdate').' '.$request->get('reftime'))));
	    	$changedDraw->start_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('startissue'))));
	    	$changedDraw->end_at = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->get('endissue'))));
	    	$changedDraw->score = $request->get('score');
	    	$changedDraw->invitations = $request->get('invitations');
	    	$changedDraw->type = $type;
	    	
	    	$changedDraw->save();

            //update Sitemap after the draw was saved
            Event::fire(new UpdateSitemap());
	    	
            return redirect('admin/draws')->with('status','Round of invitations successfully saved!');
	    }else{
	    	return redirect('admin/draws');
	    }
    }

    /**
     * Show Edit round of invitations page
     */
    public function getEditDrawPage($id){
    	$draw = Draw::find($id);
    	if($draw){
    		return view('back.draws.edit')->with('draw', $draw);
    	} else {
    		return redirect('admin/draws');
    	}
    }

    /**
     * Show Delete round of invitations page
     */
    public function getDeleteDrawPage($id){
    	$draw = Draw::find($id);
    	if($draw){
    		return view('back.draws.delete')->with('draw', $draw);
    	} else {
    		return redirect('admin/draws');
    	}
    }

    /**
     * Process requewst from delete round of invitations page
     */
    public function postDeleteDraw(Request $request){
    	$draw = Draw::find($request->get('id'));
    	if($draw){
    		$draw->delete();
            Event::fire(new UpdateSitemap());
    		return redirect('admin/draws')->with('status','Round of invitations successfully deleted!');
    	} else {
    		return redirect('admin/draws');
    	}
    }

    /**
     * Return a JSON containig all valid rounds of invitations
     */
    public function getRoundsJson(){
        $draws = Draw::where('status', 1)->get()->toArray();
        return(json_encode($draws));
    }
}
