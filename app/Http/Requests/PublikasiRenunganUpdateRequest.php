<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class PublikasiRenunganUpdateRequest extends FormRequest
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
    * @return array<string, mixed>
    */
   public function rules()
   {
       return [
        'tanggal_publikasi' => ['required'], 
        'id_bahan_bacaan' => ['required'], 
        'id_pengguna' => ['required'], 
       ];
   }

//    protected function failedValidation(Validator $validator)
//    {
//        throw new HttpResponseException(response ([
//            "errors" => $validator->getMessageBag()
//        ], 400));
//    }

   /**
    * Configure the validator instance.
    *
    * @param  \Illuminate\Validation\Validator  $validator
    * @return void
    */
   
}

