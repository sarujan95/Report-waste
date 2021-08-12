<?php

namespace App\Http\Controllers\Admin\Recent_events;

use App\Http\Controllers\Controller;
use App\Models\RecentEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecentEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = RecentEvent::all();
        return view('admin.recent_events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.recent_events.event_add_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $eventid = $request->eventid;
        // $validated = $request->validate([
        //     'title' => 'required|unique:services,title,{$sid},id|max:50',
        //     'short_description' => 'required',
        //     'long_description' => 'required',
        //     'icon' => 'exclude_if:old_icon,false|required|mimes:png|dimensions:width=512,height=512',
        //     'image' => 'required|mimes:jpg,jpeg,png|dimensions:width=380,height=440'
        // ]);
        // $validator = Validator::make($request->all(), [
        //     'title' => [Rule::unique('services')->ignore($sid),],
        //     'short_description' => 'required',
        //     'long_description' => 'required',
        //     'icon' => 'exclude_if:old_icon,null|required|mimes:png|dimensions:width=512,height=512',
        //     'image' => 'required|mimes:jpg,jpeg,png|dimensions:width=380,height=440'
        // ])->validate();
      
        $c_time = time();

        $image_path = 'recent_event/';

        $image_name = 'img_'.$c_time;

        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

    if(!$eventid){
        $recent_event = new RecentEvent;
    }else{
            $image_stored_path = $request->old_image;
            $recent_event = RecentEvent::find($eventid);
        }

           
        if($img_ext = $request->file('image')){
            $img_ext = $request->file('image')->extension();
            $image_stored_path = $request->file('image')->storeAs(
            $image_path, $image_name.'.'.$img_ext, 'public'
            );
        } 

        $recent_event->title = $request->title;
        $recent_event->date = $request->date;
        $recent_event->services = $request->services;
        $recent_event->short_description = $request->short_description;
        $recent_event->image = $image_stored_path;
        $recent_event->status = $status;
        $recent_event->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $recent_event = RecentEvent::find($id);
        return view('admin.recent_events.event_add_edit', ['event' => $recent_event]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = RecentEvent::find($id);
        
        Storage::disk('public')->delete($event->image);
        $event->delete();
        
        return back();
    }
}
