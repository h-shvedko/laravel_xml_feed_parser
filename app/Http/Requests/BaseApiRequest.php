<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

/**
 * Class BaseApiRequest
 * @package App\Http\Requests
 */
abstract class BaseApiRequest extends FormRequest
{

    public function put(&$var, $path, $value)
    {
        foreach (explode('.', $path) as $p) {
            $var = &$var[$p];
        }

        $var = $value;
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     *
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        $errors = [];

        foreach ($validator->errors()->getMessages() as $k => $v) {
            $this->put($errors, $k, $v);
        }

        throw new HttpResponseException(response()->json([
            'errors' => $errors,
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
