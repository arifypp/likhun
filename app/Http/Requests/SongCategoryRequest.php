<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongCategoryRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|unique:song_categories,name,' . $this->id,
            'status' => 'required:in:active,inactive',
            'is_featured' => 'required:in:yes,no',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'nullable',
            'is_special' => 'required:in:yes,no',
            'order' => 'nullable|integer',
            'parent_id' => 'nullable|integer',
        ];
    }
}
