<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create',Post::class);;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:posts,title|min:3',
            'description' => 'required|min:20',
            'category_id' => 'required|integer|exists:categories,id',
            'photo' => 'required',
            "tags" => "required",
            "tags.*" => "integer|exists:tags,id",
            'photo.*' => 'required|file|mimes:jpg,png',
        ];
    }

    public function messages(){
        return [
            'title.required' => 'please add the title'
        ];
    }
}
