<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Foundation\Http\HttpResponseException;

class APIRequest extends FormRequest
{
    protected function faildValidation(Validator $validator)
    {
        throw new HttpResponseException(response(['errors' => $validator->errors(), 400]));
    }
}