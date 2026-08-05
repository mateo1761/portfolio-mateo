<?php

namespace App\Http\Requests;

use App\Concerns\ExperienceValidationRules;
use App\Models\Experience;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExperienceRequest extends FormRequest
{
    use ExperienceValidationRules;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $experience = $this->route('experience');

        return $experience instanceof Experience
            && ($this->user()?->can('update', $experience) ?? false);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return $this->experienceRules();
    }
}
