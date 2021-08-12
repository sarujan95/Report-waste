<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\RecentEvent;
use App\Models\RecentEventGallery;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Models\ServiceSample;
use App\Models\ServiceSelection;
use App\Models\ServiceSelectionImage;
use Illuminate\Http\Request;

class PageController extends Controller
{
   public function serviceDetail($id)
   {
        $service = Service::find($id);
        $samples = ServiceSample::where('service_id',$id)->orderByDesc('id')->get();
        $selections = ServiceSelection::where('service_id',$id)->where('status', 1)->orderByDesc('id')->get();
        $packages = ServicePackage::where('service_id',$id)->where('status', 1)->orderByDesc('id')->get();

        return view('service_detail',['service' => $service, 'samples' => $samples, 'selections' => $selections, 'packages' => $packages]);
   }


   public function about()
   {
       return view('about');
   }

   public function gallery()
   {
      $gallery = Gallery::orderByDesc('id')->get();;
       return view('gallery',['photos' => $gallery]);
   }

   public function recentEvents()
   {
      $recent_events = RecentEvent::orderByDesc('id')->get();

      return view('recent_event',['recent_event'=>$recent_events]);

   }

   public function recentEventGallery($id)
   {
      $images = RecentEventGallery::where('event_id',$id)->orderByDesc('id')->get();

      return view('recent_event_gallery',['images'=>$images]);
   }
   public function getServiceSelectionImageView(Request $request)
   {
      $images = ServiceSelectionImage::where('selection_id',$request->get('id'))->orderByDesc('id')->get();
      return view('shared.gallerySlider',['images'=>$images]);
   }
}
