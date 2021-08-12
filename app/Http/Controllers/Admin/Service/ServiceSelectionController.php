<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\ServiceSelection;
use App\Models\ServiceSelectionImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceSelectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $selections = ServiceSelection::where('service_id',$id)->get();

        return view('admin.services.selections.index',['selections' => $selections , 'sid' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.services.selections.selection_add_edit',['sid' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $selection_id = $request->selection_id;
        $sid = $request->sid;
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
        $image_path = 'selection/';


        $image_name = 'img_'.$c_time;

        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }

   

        if(!$selection_id){
            $selection = new ServiceSelection;
            $selection->service_id = $sid;
        }
        else{
            $selection = ServiceSelection::find($selection_id); 
            $image_stored_path = $request->old_image;
            
        }
            
        
        if($request->file('image')){
            $img_ext = $request->file('image')->extension();

            $image_stored_path = $request->file('image')->storeAs(
                $image_path, $image_name.'.'.$img_ext, 'public'
            );
        }
        
        $selection->title = $request->title;
        $selection->short_description = $request->short_description;
        $selection->price = $request->price;
        $selection->photo = $image_stored_path;
        $selection->status = $status;
        $selection->save();
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
        $selection = ServiceSelection::find($id);
        return view('admin.services.selections.selection_add_edit', ['selection' => $selection]);
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
        $selection = ServiceSelection::find($id);

        Storage::disk('public')->delete($selection->photo);
        $selection->delete();
        
        return back();
    }

    public function image($id)
    {
        $images = ServiceSelectionImage::where('selection_id',$id)->get();
        return view('admin.services.selections.image.index',['selection_id' => $id, 'images' => $images]);
    }

    public function addImage($id)
    {

        return view('admin.services.selections.image.add',['selection_id' => $id]);
    }

    public function storeImage(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png'
        ]);
        
        $image_path = 'services/selection/image';

        $image_ext = $request->file('file')->extension();
        $image_org_name = $request->file('file')->getClientOriginalName();;

        $image_name = 'img_'.uniqid();
        $image_stored_path = $request->file('file')->storeAs(
            $image_path, $image_name.time().'.'.$image_ext,'public'
        );

        $selection_images = new ServiceSelectionImage;
        $selection_images->image = $image_stored_path;
        $selection_images->selection_id = $request->selectionid;
        $selection_images->save(); 
    }

    public function destroyImage($id)
    {
        $selection_image = ServiceSelectionImage::find($id);

        Storage::disk('public')->delete($selection_image->image);
        $selection_image->delete();
        
        return back();
    }
}
