<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Auth;

class Laboratorio extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return !Auth::guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'location'=>'required',
            'panoramicImage'=>'required'
        ];
    }

    public function messages(){
        return[
          'name.required'=>'O nome do local é obrigatorio.',
          'location.required'=>'O local onde é obrigatorio.',
          'panoramicImage.*'=>'Carrege um arquivo de imagem.'
        ];
    }
}
