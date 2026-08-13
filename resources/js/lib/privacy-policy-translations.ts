import type { PortfolioLocale } from '@/lib/portfolio-translations';

interface PrivacySection {
    heading: string;
    paragraphs?: ReadonlyArray<string>;
    items?: ReadonlyArray<string>;
}

export interface PrivacyPolicyCopy {
    skipToContent: string;
    backToPortfolio: string;
    languageLabel: string;
    alternateLanguage: string;
    eyebrow: string;
    title: string;
    introduction: string;
    versionLabel: string;
    effectiveDateLabel: string;
    effectiveDate: string;
    sections: ReadonlyArray<PrivacySection>;
    reviewNotice: string;
}

export const privacyPolicyCopy: Record<PortfolioLocale, PrivacyPolicyCopy> = {
    es: {
        skipToContent: 'Saltar al contenido',
        backToPortfolio: 'Volver al portafolio',
        languageLabel: 'Cambiar idioma',
        alternateLanguage: 'English',
        eyebrow: 'Privacidad',
        title: 'Política de tratamiento de datos personales',
        introduction:
            'Esta política explica, en lenguaje claro, cómo Mateo Quintero Zapata trata los datos personales recibidos mediante Portafolio Mateo.',
        versionLabel: 'Versión',
        effectiveDateLabel: 'Vigente desde',
        effectiveDate: '12 de agosto de 2026',
        sections: [
            {
                heading: '1. Responsable del tratamiento',
                paragraphs: [
                    'Mateo Quintero Zapata, persona natural ubicada en Medellín, Colombia, es el responsable del tratamiento. Las consultas, reclamos, solicitudes de acceso, corrección, supresión o revocación pueden enviarse a mateoquinterozapata@gmail.com.',
                ],
            },
            {
                heading: '2. Datos tratados y origen',
                paragraphs: [
                    'El formulario recibe nombre, correo electrónico, asunto, mensaje, idioma seleccionado y la autorización de privacidad. El servicio también procesa temporalmente identificadores de sesión y CSRF, fecha y hora de la solicitud, dirección IP para limitar abusos y datos técnicos incluidos en logs operativos.',
                    'El portafolio publica voluntariamente información profesional, una fotografía y una hoja de vida sanitizada de Mateo. Estos datos son distintos de la información enviada por los visitantes.',
                ],
            },
            {
                heading: '3. Finalidades',
                items: [
                    'Recibir, responder y realizar seguimiento a consultas sobre proyectos, vacantes u oportunidades profesionales.',
                    'Proteger el formulario, prevenir abuso y mantener la seguridad y disponibilidad del sitio.',
                    'Obtener métricas agregadas de visitas y formularios enviados correctamente, sin guardar nombres, correos, mensajes, perfilado, huellas digitales, cookies analíticas ni direcciones IP en estos contadores.',
                ],
            },
            {
                heading: '4. Autorización y evidencia',
                paragraphs: [
                    'El envío exige una casilla de autorización previa, expresa e informada, desmarcada inicialmente. Como evidencia proporcional, el correo generado incluye el estado de aceptación, la fecha y hora UTC, el idioma y la versión de esta política.',
                    'Además, se conserva un registro mínimo separado con un identificador UUID, una huella HMAC-SHA256 no reversible del correo normalizado, la fecha y hora UTC, el idioma y la versión de esta política. Este registro no contiene el nombre, correo legible, asunto, mensaje, dirección IP ni agente del navegador.',
                ],
            },
            {
                heading: '5. Conservación y eliminación',
                items: [
                    'Los correos de contacto se conservarán durante un mes contado desde la última interacción y después se eliminarán, salvo que surja una obligación legal o una relación contractual que requiera informar una finalidad y plazo diferentes.',
                    'El registro mínimo de autorización se conservará durante 12 meses desde el envío y después se eliminará automáticamente. Su única finalidad es permitir demostrar la autorización sin conservar el contenido del mensaje ni el correo en texto legible.',
                    'Los logs operativos y backups ordinarios se conservarán hasta 90 días.',
                    'Los registros asociados con un incidente documentado podrán conservarse hasta un año.',
                    'Los datos temporales de sesión, CSRF, caché y limitación de solicitudes expiran conforme a la configuración técnica del servicio.',
                    'Los conteos diarios agregados de visitas y formularios enviados se conservarán durante 12 meses. No permiten identificar visitantes ni reconstruir el contenido de una consulta.',
                ],
            },
            {
                heading: '6. Destinatarios y proveedores',
                paragraphs: [
                    'Mateo podrá acceder a los mensajes y a la información necesaria para operar y proteger el sitio. El proveedor de hosting, el servicio de correo transaccional y sus ubicaciones de procesamiento todavía no han sido seleccionados. Esta política deberá actualizarse antes del despliegue público para identificarlos y explicar cualquier transmisión o transferencia internacional.',
                ],
            },
            {
                heading: '7. Derechos de las personas',
                paragraphs: [
                    'Puedes conocer, actualizar y corregir tus datos; solicitar prueba de la autorización; conocer el uso dado a la información; presentar quejas ante la Superintendencia de Industria y Comercio; y solicitar la supresión o revocar la autorización cuando proceda.',
                    'Envía tu solicitud a mateoquinterozapata@gmail.com indicando tu nombre, la petición concreta y la información necesaria para localizar el mensaje. Se responderá por el mismo canal dentro de los plazos aplicables en Colombia, previa verificación razonable de identidad.',
                ],
            },
            {
                heading: '8. Menores de edad',
                paragraphs: [
                    'El sitio es de audiencia general y no está dirigido específicamente a menores de edad. Un menor no debe enviar datos personales sin la intervención de su representante legal. Si se identifica información de un menor recibida sin autorización adecuada, se eliminará de manera prioritaria.',
                ],
            },
            {
                heading: '9. Seguridad e incidentes',
                paragraphs: [
                    'Se aplican controles técnicos razonables como HTTPS, CSRF, validación, limitación de solicitudes y acceso administrativo autenticado. Ningún sistema es infalible. Los incidentes se evaluarán, contendrán y documentarán, y se realizarán las comunicaciones exigibles cuando corresponda.',
                ],
            },
            {
                heading: '10. Cookies y recursos externos',
                paragraphs: [
                    'Actualmente solo se usan cookies o identificadores técnicos esenciales para seguridad, sesión y autenticación administrativa. La medición propia usa únicamente contadores diarios agregados y no instala cookies analíticas. No hay publicidad ni perfilado, por lo que no se muestra un banner de consentimiento de cookies. Los enlaces externos solo transmiten datos a terceros cuando el visitante decide abrirlos.',
                ],
            },
            {
                heading: '11. Cambios a esta política',
                paragraphs: [
                    'Los cambios materiales tendrán una nueva versión y fecha de vigencia. Si cambian las finalidades, proveedores o transferencias internacionales, se actualizará la información y se solicitará una nueva autorización cuando sea necesario.',
                ],
            },
        ],
        reviewNotice:
            'Documento técnico preparado para revisión. No constituye asesoría legal ni una declaración de cumplimiento.',
    },
    en: {
        skipToContent: 'Skip to content',
        backToPortfolio: 'Back to portfolio',
        languageLabel: 'Change language',
        alternateLanguage: 'Español',
        eyebrow: 'Privacy',
        title: 'Personal Data Processing Policy',
        introduction:
            'This policy explains in plain language how Mateo Quintero Zapata processes personal data received through Portafolio Mateo.',
        versionLabel: 'Version',
        effectiveDateLabel: 'Effective from',
        effectiveDate: 'August 12, 2026',
        sections: [
            {
                heading: '1. Data controller',
                paragraphs: [
                    'Mateo Quintero Zapata, a natural person located in Medellín, Colombia, is the data controller. Questions, complaints, and requests for access, correction, deletion, or withdrawal may be sent to mateoquinterozapata@gmail.com.',
                ],
            },
            {
                heading: '2. Data processed and its source',
                paragraphs: [
                    'The form receives a name, email address, subject, message, selected language, and privacy authorization. The service also temporarily processes session and CSRF identifiers, request date and time, an IP address for abuse prevention, and technical data contained in operational logs.',
                    'The portfolio voluntarily publishes Mateo’s professional information, photograph, and sanitized résumé. This information is separate from data submitted by visitors.',
                ],
            },
            {
                heading: '3. Purposes',
                items: [
                    'Receive, answer, and follow up on inquiries about projects, vacancies, or professional opportunities.',
                    'Protect the form, prevent abuse, and maintain the security and availability of the site.',
                    'Obtain aggregate metrics for visits and successfully submitted forms without storing names, email addresses, messages, profiles, fingerprints, analytics cookies, or IP addresses in these counters.',
                ],
            },
            {
                heading: '4. Authorization and evidence',
                paragraphs: [
                    'Submission requires prior, express, and informed authorization through a checkbox that is initially unchecked. As proportionate evidence, the generated email includes the acceptance status, UTC date and time, language, and policy version.',
                    'A separate minimal record is also retained with a UUID, a non-reversible HMAC-SHA256 fingerprint of the normalized email address, the UTC date and time, language, and this policy version. This record does not contain the name, readable email address, subject, message, IP address, or browser user agent.',
                ],
            },
            {
                heading: '5. Retention and deletion',
                items: [
                    'Contact emails will be kept for one month from the last interaction and then deleted, unless a legal obligation or contractual relationship requires a different disclosed purpose and period.',
                    'The minimal authorization record will be retained for 12 months after submission and then automatically deleted. Its sole purpose is to demonstrate authorization without retaining the message content or a readable email address.',
                    'Ordinary operational logs and backups will be retained for up to 90 days.',
                    'Records associated with a documented incident may be retained for up to one year.',
                    'Temporary session, CSRF, cache, and rate-limiting data expire according to the service’s technical configuration.',
                    'Aggregate daily counts of visits and submitted forms will be retained for 12 months. They cannot identify visitors or reconstruct the content of an inquiry.',
                ],
            },
            {
                heading: '6. Recipients and providers',
                paragraphs: [
                    'Mateo may access messages and the information required to operate and secure the site. The hosting provider, transactional email service, and their processing locations have not yet been selected. This policy must be updated before public deployment to identify them and explain any international transmission or transfer.',
                ],
            },
            {
                heading: '7. Individual rights',
                paragraphs: [
                    'You may access, update, and correct your data; request proof of authorization; learn how the information has been used; submit complaints to Colombia’s Superintendence of Industry and Commerce; and request deletion or withdraw authorization when applicable.',
                    'Send your request to mateoquinterozapata@gmail.com with your name, the specific request, and enough information to locate the message. After reasonable identity verification, a response will be provided through the same channel within the time limits applicable in Colombia.',
                ],
            },
            {
                heading: '8. Children and teenagers',
                paragraphs: [
                    'The site is intended for a general audience and is not specifically directed at minors. A minor should not submit personal data without the involvement of a legal representative. If information from a minor is identified without appropriate authorization, it will be prioritized for deletion.',
                ],
            },
            {
                heading: '9. Security and incidents',
                paragraphs: [
                    'Reasonable technical controls include HTTPS, CSRF protection, validation, request throttling, and authenticated administrative access. No system is infallible. Incidents will be assessed, contained, and documented, and required notices will be issued when applicable.',
                ],
            },
            {
                heading: '10. Cookies and external resources',
                paragraphs: [
                    'Only essential cookies or technical identifiers for security, sessions, and administrator authentication are currently used. First-party measurement uses aggregate daily counters and does not install analytics cookies. There is no advertising or profiling, so no cookie-consent banner is displayed. External links transmit data to third parties only when a visitor chooses to open them.',
                ],
            },
            {
                heading: '11. Policy changes',
                paragraphs: [
                    'Material changes will receive a new version and effective date. If purposes, providers, or international transfers change, the information will be updated and fresh authorization will be requested when necessary.',
                ],
            },
        ],
        reviewNotice:
            'Technical document prepared for review. It is not legal advice or a statement of compliance.',
    },
};
