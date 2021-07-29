<?php

namespace App\Http\Controllers\CRUD;

use App\Events\VideoViewer;
use App\Http\Controllers\Controller;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Models\Video;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CRUDController extends Controller
{
    use OfferTrait;
    public function getOffers(){
       return Offer::select('*')->get();
    }
    public function index(){
        //$offers = Offer::get();
        $offers = Offer::select('id','price',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details',
            'img'
        )->get();
        return view('crud.index')->with('offers',$offers);
    }
    public function create(){
        return view('crud.create');
    }
    public function store(OfferRequest $offerRequest){
        // this way you use it if you dont want to make request file
//        $rules= [
//            'name'=>'required|max:100|unique:offers,name',
//            'price'=>'required|numeric',
//            'details'=>'required',
//        ];
//        $massages = $this->getMassages();
//        $validator = Validator::make($request->all(),$rules,$massages);
//        if ($validator->fails()){
//            return redirect()->back()->withErrors($validator)->withInput($request->all());
//        }
//        $name = $offerRequest->name;
//        $price = $offerRequest->price;
//        $details= $offerRequest->details;
//        Offer::create([
//            'name'=>$name,
//            'price'=>$price,
//            'details'=>$details
//            ]);
//        return redirect()->back()->with(['success'=>'you offer are add successfully']);

        //or use your old way
//        $offer = new Offer();
//        $offer->name = 'IPHONE7';
//        $offer->price = '250';
//        $offer->details = 'iphone 7 secondhand for sale';
//        $offer->save();
// save image in folder first
        $file_name =$this->saveImage($offerRequest->img ,'Images/Offers');
        $name_ar = $offerRequest->name_ar;
        $name_en = $offerRequest->name_en;
        $price = $offerRequest->price;
        $details_ar= $offerRequest->details_ar;
        $details_en= $offerRequest->details_en;
        Offer::create([
            'img'=>$file_name,
            'name_ar'=>$name_ar,
            'name_en'=>$name_en,
            'price'=>$price,
            'details_ar'=>$details_ar,
            'details_en'=>$details_en
        ]);
        return redirect()->back()->with(['success'=>__('messages.success')]);
    }



//    protected function getMassages(){
//        return  $massages=
//            [
//                'name.required'=>__('messages.NameRequired') ,
//                'price.required'=>__('messages.PriceRequired'),
//                'details.required'=>__('messages.DetailsRequired'),
//                'name.max'=>__('messages.NameMax'),
//                'name.unique'=>__('messages.NameUnique'),
//                'price.numeric'=>('messages.PriceNumeric'),
//            ];
//    }
public function edit($id){
Offer::findOrFail($id);
$offer= Offer::select('*')->where('id',$id)->first();
return view('crud.edit')->with('offer',$offer);
}
public function update(OfferRequest $offerRequest,$id){
        //check if offer exists
    $offer = offer::find($id)->first();
    if (!$offer)
        return redirect()->back();
$new_name_ar = $offerRequest->name_ar;
$new_name_en = $offerRequest->name_en;
$new_price = $offerRequest->price;
$new_details_ar = $offerRequest->details_ar;
$new_details_en = $offerRequest->details_en;
//$offer->update([
//    'name_ar'=>$new_name_ar,
//    'name_en'=>$new_name_en,
//    'price'=>$new_price,
//    'details_ar'=>$new_details_ar,
//    'details_en'=>$new_details_en,
//]);
    $offer->update($offerRequest->all());
    return redirect()->back()->with(['success'=>__('messages.success')]);
}
public function delete($id){
        //first check if id exists or not
    $offer = Offer::find($id);
    if(!$offer)
    { return redirect()->back()->with(['error'=>__('messages.error')]);}
    $offer->delete();
return redirect()
    ->route('offers.index',$id)
   // ->back()
    ->with(['success'=>__('messages.success')]);
}
public  function getVideo(){
       $video = Video::select('*')->first();
       event(new VideoViewer($video));
return view('Video.video')->with('video',$video);
}

}
