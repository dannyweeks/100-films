<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class QuickAddRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->get('passcode') === config('auth.passcode');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'imdb_id' => 'film_exists|unique:films,imdb_id',
        ];
    }

    public function messages()
    {
        return [
            'imdb_id.film_exists' => 'The ID provided does not exist on IMDB',
            'imdb_id.exists' => 'This film is already on the list',
        ];
    }
}
