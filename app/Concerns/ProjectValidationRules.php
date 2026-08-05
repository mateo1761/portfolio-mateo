<?php

namespace App\Concerns;

use Illuminate\Contracts\Validation\ValidationRule;

trait ProjectValidationRules
{
    /**
     * Get the validation rules shared by project requests.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    protected function projectRules(): array
    {
        return [
            'title_es' => ['required', 'string', 'max:255'],
            'title_en' => ['required', 'string', 'max:255'],
            'category_es' => ['required', 'string', 'max:255'],
            'category_en' => ['required', 'string', 'max:255'],
            'description_es' => ['required', 'string', 'max:5000'],
            'description_en' => ['required', 'string', 'max:5000'],
            'technologies_es' => ['required', 'string', 'max:255'],
            'technologies_en' => ['required', 'string', 'max:255'],
            'repository_url' => ['nullable', 'url:http,https', 'max:2048'],
            'is_private' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:32767'],
        ];
    }

    /**
     * Get human-readable validation messages for the administration form.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be text.',
            'max' => 'The :attribute may not be greater than :max.',
            'url' => 'The :attribute must be a valid HTTP or HTTPS URL.',
            'boolean' => 'The :attribute field must be true or false.',
            'integer' => 'The :attribute must be a whole number.',
            'min' => 'The :attribute must be at least :min.',
        ];
    }

    /**
     * Get human-readable names for project attributes.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'title_es' => 'Spanish title',
            'title_en' => 'English title',
            'category_es' => 'Spanish category',
            'category_en' => 'English category',
            'description_es' => 'Spanish description',
            'description_en' => 'English description',
            'technologies_es' => 'Spanish technologies',
            'technologies_en' => 'English technologies',
            'repository_url' => 'repository URL',
            'is_private' => 'private project option',
            'is_published' => 'publication option',
            'sort_order' => 'sort order',
        ];
    }
}
