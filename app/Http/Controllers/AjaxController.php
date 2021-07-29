<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AjaxController extends Controller
{
    use OfferTrait;
    /// here to create offer just in case you forgot
    public function create(){
    return view('ajaxoffer.create');

    }

    public function store(OfferRequest $offerRequest){
       $file_name =$this->saveImage($offerRequest->img ,'Images/Offers');
        $name_ar = $offerRequest->name_ar;
        $name_en = $offerRequest->name_en;
        $price = $offerRequest->price;
        $details_ar= $offerRequest->details_ar;
        $details_en= $offerRequest->details_en;
        $offer=Offer::create([
            'img'=>$file_name,
            'name_ar'=>$name_ar,
            'name_en'=>$name_en,
            'price'=>$price,
            'details_ar'=>$details_ar,
            'details_en'=>$details_en
        ]);
        if($offer)
        return response()->json([
            'status'=>true,
            'message'=>'save done successfully'
        ]);
        else
            return response()->json([
                'status'=>false,
                'message'=>'save didnt done successfully'
            ]);
    }
    public function index(){
        $offers = Offer::select('id','price',
            'name_'.LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details',
            'img'
        )->get();
        return view('ajaxoffer.index')->with('offers',$offers);
    }
    public function delete(Request $request){
        $offer = Offer::find($request->id);
        if(!$offer)
        {   return response()->json([
            'status'=>false,
            'message'=>'save didnt done successfully',

        ]);}
        $offer->delete();
        return response()->json([
            'status'=>true,
            'message'=>'save  done successfully',
            'id'=>$request->id,
        ]);

    }
    public function edit($id){
        Offer::findOrFail($id);
        $offer= Offer::select('*')->where('id',$id)->first();
        return view('ajaxoffer.edit')->with('offer',$offer);
    }
    public function update(Request $request){
        $file_name =$this->saveImage($request->img ,'Images/Offers');
        $new_name_ar = $request->name_ar;
        $new_name_en = $request->name_en;
        $new_price = $request->price;
        $new_details_ar = $request->details_ar;
        $new_details_en = $request->details_en;
//        check if offer exists
        $offer = offer::find($request->id)->first();
        if (!$offer)
            return response()->json([
                'status'=>false,
                'message'=>'save didnt done successfully',]);
       // $offer->update($request->all());//this if you dont have a img to save
        $offer->update([
            'img'=>$file_name,
            'name_ar'=>$new_name_ar,
            'name_en'=>$new_name_en,
            'price'=>$new_price,
            'details_ar'=>$new_details_ar,
            'details_en'=>$new_details_en,
        ]);
        return response()->json([
            'status'=>true,
            'message'=>'save done successfully',
        ]);
    }
}
