<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
    <meta name="supported-color-schemes" content="dark">
    <title>Restablece tu contraseña</title>
</head>
<body style="margin: 0; padding: 0; background-color: #09111a; color: #f4f1ea; font-family: Arial, Helvetica, sans-serif;" bgcolor="#09111A">
    <div style="display: none; max-height: 0; overflow: hidden; opacity: 0; color: transparent; line-height: 1px;">
        Usa este enlace seguro para restablecer la contraseña de administración.
    </div>

    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#09111A" style="width: 100%; background-color: #09111a;">
        <tr>
            <td align="center" style="padding: 32px 16px;">
                <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#0D1722" style="width: 100%; max-width: 600px; background-color: #0d1722; border: 1px solid #2e3b49;">
                    <tr>
                        <td style="padding: 40px 40px 30px;">
                            <p style="margin: 0 0 10px; color: #c39a3c; font-size: 12px; font-weight: 700; letter-spacing: 1.5px; line-height: 18px; text-transform: uppercase;">
                                Acceso administrativo
                            </p>
                            <h1 style="margin: 0; color: #f4f1ea; font-size: 30px; font-weight: 700; line-height: 38px;">
                                Restablece tu contraseña
                            </h1>
                            <p style="margin: 16px 0 0; color: #aeb7c2; font-size: 16px; line-height: 26px;">
                                Recibimos una solicitud para cambiar la contraseña del panel privado de Portafolio.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px;">
                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" bgcolor="#142233" style="width: 100%; background-color: #142233; border-left: 3px solid #c39a3c;">
                                <tr>
                                    <td style="padding: 20px; color: #aeb7c2; font-size: 14px; line-height: 23px;">
                                        El enlace es personal, solo puede utilizarse una vez y vencerá en
                                        <strong style="color: #f4f1ea;">{{ $expiresInMinutes }} minutos</strong>.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td align="center" style="padding: 32px 40px;">
                            <table role="presentation" cellspacing="0" cellpadding="0" border="0">
                                <tr>
                                    <td align="center" bgcolor="#C39A3C" style="background-color: #c39a3c; border-radius: 6px;">
                                        <a href="{{ $resetUrl }}" style="display: inline-block; padding: 15px 24px; color: #09111a; font-size: 15px; font-weight: 700; line-height: 20px; text-decoration: none;">
                                            Restablecer contraseña
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 32px;">
                            <p style="margin: 0 0 10px; color: #aeb7c2; font-size: 13px; line-height: 21px;">
                                Si el botón no funciona, copia y pega este enlace en tu navegador:
                            </p>
                            <p style="margin: 0; color: #c39a3c; font-size: 12px; line-height: 20px; overflow-wrap: anywhere; word-break: break-all;">
                                <a href="{{ $resetUrl }}" style="color: #c39a3c; text-decoration: underline;">{{ $resetUrl }}</a>
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 40px;">
                            <p style="margin: 0; color: #aeb7c2; font-size: 13px; line-height: 21px;">
                                Si no solicitaste este cambio, ignora el mensaje. Tu contraseña actual seguirá funcionando y no se realizará ninguna modificación.
                            </p>
                        </td>
                    </tr>

                    <tr>
                        <td bgcolor="#09111A" style="padding: 26px 40px; background-color: #09111a; border-top: 1px solid #2e3b49;">
                            <p style="margin: 0; color: #f4f1ea; font-size: 14px; font-weight: 700; line-height: 21px;">
                                Portafolio
                            </p>
                            <p style="margin: 4px 0 0; color: #aeb7c2; font-size: 12px; line-height: 19px;">
                                Mensaje automático de seguridad. No respondas a este correo.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
