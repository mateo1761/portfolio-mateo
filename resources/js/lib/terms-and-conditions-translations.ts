import type { PortfolioLocale } from '@/lib/portfolio-translations';

interface TermsSection {
    heading: string;
    paragraphs?: ReadonlyArray<string>;
    items?: ReadonlyArray<string>;
}

export interface TermsAndConditionsCopy {
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
    sections: ReadonlyArray<TermsSection>;
    reviewNotice: string;
}

export const termsAndConditionsCopy: Record<
    PortfolioLocale,
    TermsAndConditionsCopy
> = {
    es: {
        skipToContent: 'Saltar al contenido',
        backToPortfolio: 'Volver al portafolio',
        languageLabel: 'Cambiar idioma',
        alternateLanguage: 'English',
        eyebrow: 'Información legal',
        title: 'Términos y condiciones',
        introduction:
            'Estos términos establecen las condiciones de acceso y uso de Portafolio Mateo, un sitio personal de carácter profesional e informativo.',
        versionLabel: 'Versión',
        effectiveDateLabel: 'Vigente desde',
        effectiveDate: '4 de agosto de 2026',
        sections: [
            {
                heading: '1. Titular y alcance',
                paragraphs: [
                    'Portafolio Mateo es operado personalmente por Mateo Quintero Zapata, persona natural ubicada en Medellín, Colombia. Estos términos se aplican a la navegación por el sitio, la consulta de sus contenidos, la descarga de documentos públicos y el uso del formulario de contacto.',
                    'El acceso al sitio implica el deber de utilizarlo de forma lícita y respetuosa. La autorización para tratar datos personales se regula de manera independiente en la Política de tratamiento de datos personales y no equivale a aceptar estos términos.',
                ],
            },
            {
                heading: '2. Naturaleza informativa',
                paragraphs: [
                    'El sitio presenta experiencia, formación, proyectos, capacidades técnicas y medios de contacto con fines informativos y profesionales. Su contenido no constituye una oferta comercial vinculante, asesoría profesional, promesa de contratación ni obligación de celebrar un contrato.',
                ],
            },
            {
                heading: '3. Exactitud y actualización',
                paragraphs: [
                    'Se procura mantener la información clara y actualizada, pero pueden existir errores, diferencias temporales o información que requiera contexto adicional. El contenido puede corregirse o actualizarse sin previo aviso. Para tomar una decisión profesional o contractual, solicita confirmación directa de la información relevante.',
                ],
            },
            {
                heading: '4. Propiedad intelectual',
                paragraphs: [
                    'Salvo que se indique lo contrario, la identidad visual, textos, fotografía, hoja de vida, selección y presentación de contenidos pertenecen a Mateo o se utilizan con autorización. Su publicación permite consultarlos para fines personales, informativos y de evaluación profesional, pero no autoriza venderlos, atribuirse su autoría, suplantar a Mateo ni reutilizarlos de manera engañosa.',
                    'El código fuente publicado en repositorios externos se rige por la licencia indicada en cada repositorio. La disponibilidad pública del código no concede derechos adicionales cuando no exista una licencia expresa.',
                ],
            },
            {
                heading: '5. Uso permitido y conductas prohibidas',
                items: [
                    'Consultar y compartir enlaces públicos al portafolio con fines legítimos.',
                    'Descargar la hoja de vida pública para evaluar oportunidades profesionales.',
                    'No intentar acceder sin autorización al panel administrativo, cuentas, infraestructura o información no pública.',
                    'No interferir con la disponibilidad o seguridad del sitio ni eludir controles técnicos.',
                    'No enviar spam, contenido malicioso, ilegal, ofensivo o deliberadamente engañoso mediante el formulario.',
                    'No utilizar automatización abusiva, extracción masiva o cargas que afecten el servicio.',
                ],
            },
            {
                heading: '6. Formulario de contacto',
                paragraphs: [
                    'El formulario permite iniciar una conversación sobre proyectos, vacantes u oportunidades profesionales. Enviar un mensaje no garantiza respuesta, seguimiento, disponibilidad, aceptación de una propuesta ni creación de una relación contractual.',
                    'La persona remitente debe proporcionar información legítima, pertinente y que esté autorizada a compartir. No debe enviar secretos, credenciales, datos financieros, información sensible ni información confidencial de terceros.',
                ],
            },
            {
                heading: '7. Enlaces y servicios externos',
                paragraphs: [
                    'El sitio puede enlazar a GitHub, LinkedIn u otros servicios independientes. Mateo no controla sus contenidos, disponibilidad, seguridad ni prácticas de privacidad. Al abrir un enlace externo se aplican las condiciones del tercero correspondiente.',
                ],
            },
            {
                heading: '8. Disponibilidad y seguridad',
                paragraphs: [
                    'El sitio puede suspenderse temporalmente por mantenimiento, fallas, actualizaciones o circunstancias fuera del control razonable de Mateo. Se aplican medidas técnicas razonables, pero no se garantiza disponibilidad continua ni ausencia absoluta de errores o vulnerabilidades.',
                ],
            },
            {
                heading: '9. Responsabilidad',
                paragraphs: [
                    'En la medida permitida por la ley aplicable, Mateo no será responsable por decisiones tomadas exclusivamente con base en información no confirmada del portafolio, por fallas de servicios externos ni por usos contrarios a estos términos. Esta disposición no excluye responsabilidades que legalmente no puedan limitarse.',
                ],
            },
            {
                heading: '10. Cambios',
                paragraphs: [
                    'Estos términos pueden actualizarse para reflejar cambios del sitio o aclaraciones necesarias. Los cambios materiales tendrán una nueva versión y fecha de vigencia publicadas en esta página.',
                ],
            },
            {
                heading: '11. Ley aplicable y contacto',
                paragraphs: [
                    'Estos términos se interpretan conforme a las leyes de Colombia. Las diferencias se procurarán resolver primero de manera directa y de buena fe. Cuando corresponda acudir a una autoridad o juez, se aplicarán las reglas de competencia previstas por la legislación colombiana.',
                    'Las preguntas sobre estos términos pueden enviarse a mateoquinterozapata@gmail.com.',
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
        eyebrow: 'Legal information',
        title: 'Terms and Conditions',
        introduction:
            'These terms govern access to and use of Portafolio Mateo, a personal website with a professional and informational purpose.',
        versionLabel: 'Version',
        effectiveDateLabel: 'Effective from',
        effectiveDate: 'August 4, 2026',
        sections: [
            {
                heading: '1. Operator and scope',
                paragraphs: [
                    'Portafolio Mateo is personally operated by Mateo Quintero Zapata, a natural person located in Medellín, Colombia. These terms apply to browsing the site, reviewing its content, downloading public documents, and using the contact form.',
                    'Access to the site carries a duty to use it lawfully and respectfully. Authorization to process personal data is governed separately by the Personal Data Processing Policy and does not amount to acceptance of these terms.',
                ],
            },
            {
                heading: '2. Informational nature',
                paragraphs: [
                    'The site presents experience, education, projects, technical capabilities, and contact channels for informational and professional purposes. Its content is not a binding commercial offer, professional advice, a promise of engagement, or an obligation to enter into a contract.',
                ],
            },
            {
                heading: '3. Accuracy and updates',
                paragraphs: [
                    'Reasonable efforts are made to keep the information clear and current, but errors, temporary differences, or information requiring additional context may exist. Content may be corrected or updated without prior notice. Request direct confirmation of relevant information before making a professional or contractual decision.',
                ],
            },
            {
                heading: '4. Intellectual property',
                paragraphs: [
                    'Unless otherwise stated, the visual identity, text, photograph, résumé, selection, and presentation of content belong to Mateo or are used with authorization. Publication allows review for personal, informational, and professional-evaluation purposes, but does not authorize resale, false claims of authorship, impersonation, or misleading reuse.',
                    'Source code published in external repositories is governed by the license displayed in each repository. Public availability of source code grants no additional rights when no express license is provided.',
                ],
            },
            {
                heading: '5. Permitted use and prohibited conduct',
                items: [
                    'Review and share public links to the portfolio for legitimate purposes.',
                    'Download the public résumé to evaluate professional opportunities.',
                    'Do not attempt unauthorized access to the administrative panel, accounts, infrastructure, or non-public information.',
                    'Do not disrupt the availability or security of the site or bypass technical controls.',
                    'Do not send spam, malicious, unlawful, offensive, or deliberately misleading content through the form.',
                    'Do not use abusive automation, mass extraction, or loads that impair the service.',
                ],
            },
            {
                heading: '6. Contact form',
                paragraphs: [
                    'The form allows visitors to start a conversation about projects, vacancies, or professional opportunities. Sending a message does not guarantee a response, follow-up, availability, acceptance of a proposal, or creation of a contractual relationship.',
                    'Senders must provide legitimate, relevant information that they are authorized to share. They should not submit secrets, credentials, financial data, sensitive information, or third-party confidential information.',
                ],
            },
            {
                heading: '7. External links and services',
                paragraphs: [
                    'The site may link to GitHub, LinkedIn, or other independent services. Mateo does not control their content, availability, security, or privacy practices. The relevant third party’s terms apply when an external link is opened.',
                ],
            },
            {
                heading: '8. Availability and security',
                paragraphs: [
                    'The site may be temporarily suspended for maintenance, failures, updates, or circumstances beyond Mateo’s reasonable control. Reasonable technical safeguards are applied, but continuous availability or the complete absence of errors and vulnerabilities cannot be guaranteed.',
                ],
            },
            {
                heading: '9. Liability',
                paragraphs: [
                    'To the extent permitted by applicable law, Mateo will not be liable for decisions based exclusively on unconfirmed portfolio information, failures of external services, or uses contrary to these terms. This provision does not exclude liabilities that cannot legally be limited.',
                ],
            },
            {
                heading: '10. Changes',
                paragraphs: [
                    'These terms may be updated to reflect changes to the site or necessary clarifications. Material changes will receive a new version and effective date published on this page.',
                ],
            },
            {
                heading: '11. Governing law and contact',
                paragraphs: [
                    'These terms are interpreted under the laws of Colombia. Disputes should first be addressed directly and in good faith. Where recourse to an authority or court is appropriate, the jurisdiction rules established by Colombian law will apply.',
                    'Questions about these terms may be sent to mateoquinterozapata@gmail.com.',
                ],
            },
        ],
        reviewNotice:
            'Technical document prepared for review. It is not legal advice or a statement of compliance.',
    },
};
