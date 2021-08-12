<?php

namespace App\Http\Controllers\Admin\Service;

use App\Http\Controllers\Controller;
use App\Models\ServicePackage;
use Illuminate\Http\Request;

class ServicePackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $packages = ServicePackage::where('service_id',$id)->get();

        return view('admin.services.packages.index',['packages' => $packages , 'sid' => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('admin.services.packages.package_add_edit',['sid' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
      

        if($request->status){
            $status = 1;
        }else{
            $status = 0;
        }
        if(!$request->package_id){
            $package = new ServicePackage;
            $package->service_id = $sid;
        }else{
            $package = ServicePackage::find($request->package_id);  
        }

        $package->title = $request->title;
        $package->price = $request->price;
        $package->features = $request->features;
        $package->plan = $request->plan;
        $package->status = $status;
        $package->save();
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
        $package = ServicePackage::find($id);
        return view('admin.services.packages.package_add_edit', ['package' => $package]);
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
        $package = ServicePackage::find($id);

        $package->delete();
        
        return back();
    }
}
