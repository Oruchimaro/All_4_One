<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
            'title' => 'required|unique:posts|max:255',
            'body' => 'required',
            'cover_img' => 'required|mimes:jpeg,bmp,png',
            'category_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'title.unique' => 'A post with this title is mojood',
            'title.max' => 'Post title is too long',
            'body.required'  => 'A Post body is required',
            'cover_img.required'  => 'A Image is required',
            'cover_img.mimes'  => 'A Image must be jpg png or bmp',
            'category_id.required'  => 'Category is required',
        ];
    }
}
