<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'min:20', 'max:5000'],
            'privacy_consent' => ['required', 'accepted'],
            'company' => ['nullable', 'string', 'max:0'],
            'locale' => ['nullable', 'string', 'in:es,en'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return $this->isEnglish()
            ? [
                'name' => 'name',
                'email' => 'email',
                'subject' => 'subject',
                'message' => 'message',
                'privacy_consent' => 'privacy authorization',
            ]
            : [
                'name' => 'nombre',
                'email' => 'correo',
                'subject' => 'asunto',
                'message' => 'mensaje',
                'privacy_consent' => 'autorización de tratamiento de datos',
            ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return $this->isEnglish()
            ? [
                'name.required' => 'The name field is required.',
                'name.max' => 'The name must not exceed 100 characters.',
                'email.required' => 'The email field is required.',
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'The email must not exceed 255 characters.',
                'subject.required' => 'The subject field is required.',
                'subject.max' => 'The subject must not exceed 150 characters.',
                'message.required' => 'The message field is required.',
                'message.min' => 'The message must contain at least 20 characters.',
                'message.max' => 'The message must not exceed 5000 characters.',
                'privacy_consent.required' => 'You must authorize the processing of your personal data to send the message.',
                'privacy_consent.accepted' => 'You must authorize the processing of your personal data to send the message.',
                'company.max' => 'The message could not be sent.',
                'locale.in' => 'The selected language is invalid.',
            ]
            : [
                'name.required' => 'El campo nombre es obligatorio.',
                'name.max' => 'El nombre no debe superar los 100 caracteres.',
                'email.required' => 'El campo correo es obligatorio.',
                'email.email' => 'Ingresa una dirección de correo válida.',
                'email.max' => 'El correo no debe superar los 255 caracteres.',
                'subject.required' => 'El campo asunto es obligatorio.',
                'subject.max' => 'El asunto no debe superar los 150 caracteres.',
                'message.required' => 'El campo mensaje es obligatorio.',
                'message.min' => 'El mensaje debe contener al menos 20 caracteres.',
                'message.max' => 'El mensaje no debe superar los 5000 caracteres.',
                'privacy_consent.required' => 'Debes autorizar el tratamiento de tus datos personales para enviar el mensaje.',
                'privacy_consent.accepted' => 'Debes autorizar el tratamiento de tus datos personales para enviar el mensaje.',
                'company.max' => 'No fue posible enviar el mensaje.',
                'locale.in' => 'El idioma seleccionado no es válido.',
            ];
    }

    private function isEnglish(): bool
    {
        return $this->string('locale')->toString() === 'en';
    }
}
