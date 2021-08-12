<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\ServiceSample;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceSampleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       $samples = ServiceSample::where('service_id',$id)->get();

       return view('admin.services.samples.index',['samples' => $samples , 'sid' => $id]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.services.samples.create',['sid' => $id]);
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
        
        $image_path = 'services/samples';

        $image_ext = $request->file('file')->extension();
        $image_org_name = $request->file('file')->getClientOriginalName();;

        $image_name = 'img_'.uniqid();
        $image_stored_path = $request->file('file')->storeAs(
            $image_path, $image_name.time().'.'.$image_ext,'public'
        );

        $samples = new ServiceSample;
        $samples->photo = $image_stored_path;
        $samples->service_id = $request->sid;
        $samples->save();
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
        $sample = ServiceSample::find($id);

        Storage::disk('public')->delete($sample->photo);
        $sample->delete();
        
        return back();
    }
}
