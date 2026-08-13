<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetAdminPasswordNotification extends ResetPassword
{
    /**
     * @param  string  $url
     */
    protected function buildMailMessage($url): MailMessage
    {
        return (new MailMessage)
            ->subject('Restablece tu contraseña | Portafolio')
            ->view('mail.reset-admin-password', [
                'resetUrl' => $url,
                'expiresInMinutes' => (int) config('auth.passwords.'.config('auth.defaults.passwords').'.expire'),
            ]);
    }
}
