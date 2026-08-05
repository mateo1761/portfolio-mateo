<?php

namespace App\Http\Requests;

use App\Models\Project;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()?->can('create', Project::class) ?? false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
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
}
