<?php

namespace App\Http\Controllers\Admin\Gallery;

use App\Http\Controllers\Controller;
use App\Models\HomeGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $gallery = HomeGallery::orderByDesc('id')->get();

         return view('admin.gallery.home_gallery.index',['gallery'=>$gallery]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gallery.home_gallery.create');
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
        
        $image_path = 'home_gallery/';

        $image_ext = $request->file('file')->extension();
        $image_org_name = $request->file('file')->getClientOriginalName();;

        $image_name = 'img_'.uniqid();
        $image_stored_path = $request->file('file')->storeAs(
            $image_path, $image_name.time().'.'.$image_ext,'public'
        );

        $gallery = new HomeGallery;
        $gallery->image = $image_stored_path;
        $gallery->save();
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
         $gallery = HomeGallery::find($id);

         Storage::disk('public')->delete($gallery->image);
        $gallery->delete();
        
        return back();
    }
}
