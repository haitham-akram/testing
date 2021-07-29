<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_ar'=>'required|max:100|unique:offers,name_ar',
            'name_en'=>'required|max:100|unique:offers,name_en',
            'price'=>'required|numeric',
            'details_ar'=>'required',
            'details_en'=>'required',
            'img'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'name_en.required'=>__('messages.NameRequired') ,
            'name_ar.required'=>__('messages.NameRequired') ,
            'price.required'=>__('messages.PriceRequired'),
            'details_en.required'=>__('messages.DetailsRequired'),
            'details_ar.required'=>__('messages.DetailsRequired'),
            'name_en.max'=>__('messages.NameMax'),
            'name_en.unique'=>__('messages.NameUnique'),
            'name_ar.max'=>__('messages.NameMax'),
            'name_ar.unique'=>__('messages.NameUnique'),
            'price.numeric'=>__('messages.PriceNumeric'),
            'img.required'=>__('messages.ImgRequired'),
            ];
    }
}
