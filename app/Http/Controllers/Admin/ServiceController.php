<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::all();
        return view('admin.services.index',['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.services.service_add_edit');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   $sid = $request->sid;
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
        $icon_path = 'services/icons';
        $image_path = 'services/cover';

        $icon_name = 'ico_'.$c_time;
        $image_name = 'img_'.$c_time;

        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

    if(!$sid){
        $service = new Service;
    }else{
            $icon_stored_path = $request->old_icon;
            $image_stored_path = $request->old_image;
            $service = Service::find($sid);
        }

        
        if($icon_ext = $request->file('icon')){
                $icon_ext = $request->file('icon')->extension();
                $icon_stored_path = $request->file('icon')->storeAs(
                $icon_path, $icon_name.'.'.$icon_ext,'public'
            );
        }   
        if($img_ext = $request->file('image')){
            $img_ext = $request->file('image')->extension();
            $image_stored_path = $request->file('image')->storeAs(
            $image_path, $image_name.'.'.$img_ext, 'public'
            );
        } 

        $service->title = $request->title;
        $service->icon = $icon_stored_path;
        $service->short_description = $request->short_description;
        $service->image = $image_stored_path;
        $service->long_description = $request->long_description;
        $service->status = $status;
        $service->save();
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
       $service = Service::find($id);
        return view('admin.services.service_add_edit', ['service' => $service]);

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
        $service = Service::find($id);

        Storage::disk('public')->delete($service->icon);
        Storage::disk('public')->delete($service->image);
        
        $service->delete();
        
        return back();
    }
}
