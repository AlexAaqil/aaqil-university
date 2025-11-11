<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
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
        $sectionId = optional($this->route('section'))->id;

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sections', 'title')
                    ->where('lesson_id', $this->input('lesson_id'))
                    ->ignore($sectionId),
            ],
            'lesson_id' => 'required|numeric|exists:lessons,id',
            'sort_order' => 'nullable|numeric',
            'content' => 'required|string',
        ];
    }
}
