<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Str;

class SupplyUpdateRequest extends FormRequest
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
            'title' => ['required'],
            'header_image' => ['image', 'mimes:jpeg,png,jpg'],
            'image' => ['image', 'mimes:jpeg,png,jpg'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response ([
            "errors" => $validator->getMessageBag()
        ], 400));
    }

    /**
     * Configure the validator instance.
     *
     * @param  \Illuminate\Validation\Validator  $validator
     * @return void
     */
    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $this->merge([
                'code' => Str::slug(Str::lower($this->title)),
                'benefit_id' => json_decode($this->benefit_id)
            ]);

            $this->except(['benefit_id']);
        });
    }
}
