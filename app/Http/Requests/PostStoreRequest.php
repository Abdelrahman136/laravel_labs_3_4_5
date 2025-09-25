<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'unique:posts,title', 'string', 'min:3', 'max:255'],
            'content' => ['required', 'string', 'min:10', 'max:1000'],
            'author' => ['integer', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title is required.',
            'title.min' => 'The title must be at least 3 characters.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'title.unique' => 'The title must be unique.',
            'content.min' => 'The content must be at least 10 characters.',
            'content.max' => 'The content may not be greater than 1000 characters.',
            'content.required' => 'The content is required.',
            'author.exists' => 'The selected author does not exist.',
        ];
    }
}
