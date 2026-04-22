<?php

namespace App\Http\Requests\Courses;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LessonRequest extends FormRequest
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
        $lessonId = optional($this->route('lesson'))->id;

        return [
            'title' => [
                'required',
                'string',
                'max:255',
                // Validate uniqueness of title within the same topic, ignore current lesson on update.
                Rule::unique('lessons', 'title')
                    ->where('topic_id', $this->input('topic_id'))
                    ->ignore($lessonId),
            ],
            'topic_id' => 'required|numeric|exists:topics,id',
            'sort_order' => 'nullable|numeric|min:1',
        ];
    }
}
