<?php

namespace App\Http\Controllers\site;

use App\Http\Controllers\Controller;
use App\Mail\Complain as MailComplain;
use App\Models\ComplainImage;
use App\Models\Complain;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ComplaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $check_exist = Complain::where('postal_code', $request->postal_code)
            ->where('created_at', '>', Carbon::parse('-24 hours'))
            ->get();
        if (!($check_exist->count() > 0)) {
            $complain = new Complain;
            $complain->postal_code = $request->postal_code;
            $complain->status = 'pending';
            $complain->save();

            if ($request->hasFile('image')) {

                foreach ($request->image as $img) {
                    $image = new ComplainImage;
                    $image_path = 'complain_images';

                    $image_ext = $img->extension();

                    $image_name = 'img_' . uniqid();
                    $image_stored_path = $img->storeAs(
                        $image_path,
                        $image_name . time() . '.' . $image_ext,
                        'public'
                    );

                    $image->complain_id = $complain->id;
                    $image->image = $image_stored_path;
                    $image->save();
                }
            }
              // Mail::to($request->email)->send(new MailComplain());
        }
      
        return back()->with('success', 'Complain sent!');

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
        //
    }
}
