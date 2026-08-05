<?php

namespace App\Concerns;

trait ExperienceValidationRules
{
    /** @return array<string, array<int, string>> */
    protected function experienceRules(): array
    {
        return [
            'company' => ['required', 'string', 'max:255'],
            'role_es' => ['required', 'string', 'max:255'],
            'role_en' => ['required', 'string', 'max:255'],
            'period_es' => ['required', 'string', 'max:255'],
            'period_en' => ['required', 'string', 'max:255'],
            'location_es' => ['required', 'string', 'max:255'],
            'location_en' => ['required', 'string', 'max:255'],
            'summary_es' => ['required', 'string', 'max:5000'],
            'summary_en' => ['required', 'string', 'max:5000'],
            'is_published' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:32767'],
        ];
    }

    /** @return array<string, string> */
    public function messages(): array
    {
        return [
            'required' => 'The :attribute field is required.',
            'string' => 'The :attribute must be text.',
            'max' => 'The :attribute may not be greater than :max.',
            'boolean' => 'The :attribute field must be true or false.',
            'integer' => 'The :attribute must be a whole number.',
            'min' => 'The :attribute must be at least :min.',
        ];
    }

    /** @return array<string, string> */
    public function attributes(): array
    {
        return [
            'company' => 'company',
            'role_es' => 'Spanish role',
            'role_en' => 'English role',
            'period_es' => 'Spanish period',
            'period_en' => 'English period',
            'location_es' => 'Spanish location',
            'location_en' => 'English location',
            'summary_es' => 'Spanish summary',
            'summary_en' => 'English summary',
            'is_published' => 'publication option',
            'sort_order' => 'sort order',
        ];
    }
}
