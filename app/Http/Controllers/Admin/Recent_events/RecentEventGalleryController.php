<?php

namespace App\Http\Controllers\Admin\Recent_events;

use App\Http\Controllers\Controller;
use App\Models\RecentEventGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecentEventGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $images = RecentEventGallery::where('event_id', $id)->get();

       return view('admin.recent_events.gallery.index',['eventid' =>$id, 'images' => $images]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $images = RecentEventGallery::where('event_id', $id)->get();

        return view('admin.recent_events.gallery.add',['eventid' =>$id, 'images' => $images]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png'
        ]);
        
        $image_path = 'recent_event/gallery';

        $image_ext = $request->file('file')->extension();

        $image_name = 'img_'.uniqid();
        $image_stored_path = $request->file('file')->storeAs(
            $image_path, $image_name.time().'.'.$image_ext,'public'
        );

        $image = new RecentEventGallery;
        $image->image = $image_stored_path;
        $image->event_id = $request->eventid;
        $image->save();
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
        //
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
        $event_gallery = RecentEventGallery::find($id);

        Storage::disk('public')->delete($event_gallery->image);
        $event_gallery->delete();
        
        return back();
    }
}
