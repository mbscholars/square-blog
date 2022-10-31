<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostFilterRequest extends FormRequest
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
            'sort' => 'nullable|string|in:created_at,id,title',
            'id' => 'nullable|integer',
            'author' => 'nullable|integer',
            'category' => 'nullable|integer',
            'status' => 'nullable|string'
        ];
    }
}
