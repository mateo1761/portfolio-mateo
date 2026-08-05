<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="dark">
    <meta name="supported-color-schemes" content="dark">
    <title>Nuevo mensaje desde Portafolio Mateo</title>
</head>
<body
    style="margin: 0; padding: 0; background-color: #09111a; color: #f4f1ea; font-family: Arial, Helvetica, sans-serif;"
    bgcolor="#09111A"
>
    <div
        style="display: none; max-height: 0; overflow: hidden; opacity: 0; color: transparent; line-height: 1px;"
    >
        Nuevo mensaje de {{ $name }}: {{ $contactSubject }}
    </div>

    <table
        role="presentation"
        width="100%"
        cellspacing="0"
        cellpadding="0"
        border="0"
        bgcolor="#09111A"
        style="width: 100%; background-color: #09111a;"
    >
        <tr>
            <td align="center" style="padding: 32px 16px;">
                <table
                    role="presentation"
                    width="100%"
                    cellspacing="0"
                    cellpadding="0"
                    border="0"
                    bgcolor="#0D1722"
                    style="width: 100%; max-width: 600px; background-color: #0d1722; border: 1px solid #2e3b49;"
                >
                    <tr>
                        <td style="padding: 40px 40px 32px;">
                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                            >
                                <tr>
                                    <td>
                                        <p
                                            style="margin: 0 0 10px; color: #c39a3c; font-size: 12px; font-weight: 700; letter-spacing: 1.5px; line-height: 18px; text-transform: uppercase;"
                                        >
                                            Formulario de contacto
                                        </p>

                                        <h1
                                            style="margin: 0; color: #f4f1ea; font-size: 28px; font-weight: 700; line-height: 36px;"
                                        >
                                            Nuevo mensaje desde Portafolio Mateo
                                        </h1>

                                        <p
                                            style="margin: 14px 0 0; color: #aeb7c2; font-size: 16px; line-height: 25px;"
                                        >
                                            Una persona quiere ponerse en contacto contigo.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px;">
                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                            >
                                <tr>
                                    <td
                                        style="height: 1px; background-color: #2e3b49; font-size: 1px; line-height: 1px;"
                                        bgcolor="#2E3B49"
                                    >
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px 40px;">
                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                                bgcolor="#142233"
                                style="width: 100%; background-color: #142233;"
                            >
                                <tr>
                                    <td style="padding: 24px;">
                                        <p
                                            style="margin: 0 0 20px; color: #c39a3c; font-size: 12px; font-weight: 700; letter-spacing: 1.2px; line-height: 18px; text-transform: uppercase;"
                                        >
                                            Información del remitente
                                        </p>

                                        <table
                                            role="presentation"
                                            width="100%"
                                            cellspacing="0"
                                            cellpadding="0"
                                            border="0"
                                        >
                                            <tr>
                                                <td
                                                    valign="top"
                                                    style="padding: 0 16px 14px 0; color: #aeb7c2; font-size: 14px; line-height: 21px;"
                                                >
                                                    Nombre
                                                </td>
                                                <td
                                                    valign="top"
                                                    align="right"
                                                    style="padding: 0 0 14px; color: #f4f1ea; font-size: 14px; font-weight: 700; line-height: 21px;"
                                                >
                                                    {{ $name }}
                                                </td>
                                            </tr>

                                            <tr>
                                                <td
                                                    valign="top"
                                                    style="padding: 0 16px 0 0; color: #aeb7c2; font-size: 14px; line-height: 21px;"
                                                >
                                                    Correo
                                                </td>
                                                <td
                                                    valign="top"
                                                    align="right"
                                                    style="padding: 0; color: #f4f1ea; font-size: 14px; line-height: 21px; overflow-wrap: anywhere; word-break: break-word;"
                                                >
                                                    <a
                                                        href="mailto:{{ $email }}"
                                                        style="color: #f4f1ea; text-decoration: underline;"
                                                    >
                                                        {{ $email }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 32px;">
                            <p
                                style="margin: 0 0 10px; color: #aeb7c2; font-size: 12px; font-weight: 700; letter-spacing: 1.2px; line-height: 18px; text-transform: uppercase;"
                            >
                                Asunto
                            </p>

                            <h2
                                style="margin: 0; color: #f4f1ea; font-size: 21px; font-weight: 700; line-height: 30px;"
                            >
                                {{ $contactSubject }}
                            </h2>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px;">
                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                            >
                                <tr>
                                    <td
                                        style="height: 1px; background-color: #2e3b49; font-size: 1px; line-height: 1px;"
                                        bgcolor="#2E3B49"
                                    >
                                        &nbsp;
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 32px 40px;">
                            <p
                                style="margin: 0 0 14px; color: #c39a3c; font-size: 12px; font-weight: 700; letter-spacing: 1.2px; line-height: 18px; text-transform: uppercase;"
                            >
                                Mensaje
                            </p>

                            <div
                                style="color: #f4f1ea; font-size: 16px; line-height: 27px; overflow-wrap: anywhere; word-break: break-word;"
                            >
                                @foreach (preg_split('/\r\n|\r|\n/', $messageBody) as $messageLine)
                                    {{ $messageLine }}@unless ($loop->last)<br>@endunless
                                @endforeach
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 36px;">
                            <table
                                role="presentation"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                            >
                                <tr>
                                    <td
                                        align="center"
                                        bgcolor="#C39A3C"
                                        style="background-color: #c39a3c;"
                                    >
                                        <a
                                            href="mailto:{{ $email }}?subject={{ rawurlencode('Re: '.str_replace(["\r", "\n"], ' ', $contactSubject)) }}"
                                            style="display: inline-block; padding: 14px 22px; color: #09111a; font-size: 15px; font-weight: 700; line-height: 20px; text-decoration: none;"
                                        >
                                            Responder a {{ $name }}
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 36px;">
                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                                bgcolor="#142233"
                                style="width: 100%; background-color: #142233;"
                            >
                                <tr>
                                    <td style="padding: 20px; color: #aeb7c2; font-size: 13px; line-height: 21px;">
                                        <strong style="color: #f4f1ea;">Evidencia de autorización de privacidad</strong><br>
                                        Autorización aceptada: Sí<br>
                                        Fecha y hora UTC: {{ $consentGrantedAt }}<br>
                                        Versión de la política: {{ $policyVersion }}<br>
                                        Idioma del formulario: {{ $formLocale }}
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 0 40px 40px;">
                            <table
                                role="presentation"
                                width="100%"
                                cellspacing="0"
                                cellpadding="0"
                                border="0"
                                bgcolor="#142233"
                                style="width: 100%; background-color: #142233; border-left: 3px solid #c39a3c;"
                            >
                                <tr>
                                    <td
                                        style="padding: 18px 20px; color: #aeb7c2; font-size: 13px; line-height: 21px;"
                                    >
                                        Este mensaje se originó en el formulario de contacto de Portafolio Mateo.
                                        Responde únicamente si el contenido parece legítimo y evita compartir
                                        información sensible.
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td
                            bgcolor="#09111A"
                            style="padding: 28px 40px; background-color: #09111a; border-top: 1px solid #2e3b49;"
                        >
                            <p
                                style="margin: 0; color: #f4f1ea; font-size: 14px; font-weight: 700; line-height: 21px;"
                            >
                                Mateo Quintero Zapata
                            </p>

                            <p
                                style="margin: 4px 0 0; color: #aeb7c2; font-size: 13px; line-height: 20px;"
                            >
                                Desarrollador Full Stack Mid-Senior
                            </p>

                            <p
                                style="margin: 4px 0 0; color: #c39a3c; font-size: 13px; line-height: 20px;"
                            >
                                Portafolio Mateo
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
