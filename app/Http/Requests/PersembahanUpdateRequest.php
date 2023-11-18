<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class PersembahanUpdateRequest extends FormRequest
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
        'perolehan_persembahan' => ['required'], 
        'keterangan' => ['required'], 
        'id_jadwal_ibadah' => ['required'], 
        'id_pengguna' => ['required'], 
        'id_jenis_ibadah' => ['required'], 
        'tanggal_input' => ['required'], 

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
