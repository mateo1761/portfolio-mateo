export type PortfolioLocale = 'es' | 'en';

export interface PortfolioCopy {
    skipToContent: string;
    header: {
        navigationLabel: string;
        mobileNavigationLabel: string;
        homeLabel: string;
        menuLabel: string;
        closeMenuLabel: string;
        languageLabel: string;
        navigation: {
            about: string;
            experience: string;
            projects: string;
            contact: string;
        };
    };
    hero: {
        eyebrow: string;
        headline: string;
        headlineHighlight: string;
        introduction: string;
        location: string;
        viewProjects: string;
        downloadCv: string;
        downloadCvLabel: string;
        linkedInNewTab: string;
        portraitAlt: string;
    };
    achievements: {
        label: string;
        items: ReadonlyArray<{
            value: string;
            label: string;
        }>;
    };
    about: {
        eyebrow: string;
        heading: string;
        description: string;
        technologiesLabel: string;
        technologies: ReadonlyArray<string>;
    };
    experience: {
        eyebrow: string;
        heading: string;
        items: ReadonlyArray<{
            company: string;
            role: string;
            period: string;
            location: string;
            summary: string;
        }>;
    };
    projects: {
        eyebrow: string;
        heading: string;
        privateLabel: string;
        noRepositoryLabel: string;
        repositoryLabel: string;
        newTabLabel: string;
    };
    education: {
        eyebrow: string;
        heading: string;
        items: ReadonlyArray<{
            institution: string;
            program: string;
            period: string;
        }>;
    };
    contact: {
        eyebrow: string;
        heading: string;
        description: string;
        honeypotLabel: string;
        nameLabel: string;
        emailLabel: string;
        subjectLabel: string;
        messageLabel: string;
        messageHelp: string;
        privacyConsentPrefix: string;
        privacyConsentLink: string;
        privacyConsentSuffix: string;
        errorsTitle: string;
        errorsDescription: string;
        successMessage: string;
        sendingLabel: string;
        submitLabel: string;
        toastTitle: string;
        toastDescription: string;
    };
    footer: {
        builtWith: string;
        navigationLabel: string;
        newTabLabel: string;
        administrationLabel: string;
        privacyLabel: string;
        termsLabel: string;
    };
}

export const portfolioCopy: Record<PortfolioLocale, PortfolioCopy> = {
    es: {
        skipToContent: 'Saltar al contenido',
        header: {
            navigationLabel: 'Navegación principal',
            mobileNavigationLabel: 'Navegación móvil',
            homeLabel: 'Ir al inicio',
            menuLabel: 'Abrir menú de navegación',
            closeMenuLabel: 'Cerrar menú de navegación',
            languageLabel: 'Seleccionar idioma',
            navigation: {
                about: 'Sobre mí',
                experience: 'Experiencia',
                projects: 'Proyectos',
                contact: 'Contacto',
            },
        },
        hero: {
            eyebrow: 'Desarrollador Full Stack Mid-Senior',
            headline: 'Construyo soluciones web que mejoran',
            headlineHighlight: 'procesos reales.',
            introduction:
                'Soy Mateo, desarrollador especializado en PHP, Laravel, JavaScript y Vue.js. Transformo necesidades de negocio en aplicaciones mantenibles, integraciones y automatizaciones.',
            location: 'Sabaneta, Antioquia, Colombia',
            viewProjects: 'Ver proyectos',
            downloadCv: 'Descargar CV',
            downloadCvLabel:
                'Descargar hoja de vida de Mateo Quintero en formato PDF',
            linkedInNewTab: 'abre en una pestaña nueva',
            portraitAlt: 'Retrato profesional de Mateo Quintero Zapata',
        },
        achievements: {
            label: 'Resultados profesionales destacados',
            items: [
                {
                    value: '+600',
                    label: 'usuarios utilizaron la solución de reportes',
                },
                {
                    value: '≈50%',
                    label: 'menos tiempo en la generación de reportes',
                },
                {
                    value: '≈40%',
                    label: 'de mejora en tiempos de respuesta tras una migración',
                },
                {
                    value: 'Más de 4 años',
                    label: 'de experiencia en desarrollo de software',
                },
            ],
        },
        about: {
            eyebrow: 'Sobre mí',
            heading: 'Experiencia técnica con comprensión del negocio.',
            description:
                'He participado en el desarrollo de aplicaciones empresariales, automatización de procesos e integración de plataformas. Mi principal fortaleza está en Laravel y Vue.js, complementada con Node.js, Python, Docker y bases de datos relacionales.',
            technologiesLabel: 'Tecnologías principales y complementarias',
            technologies: [
                'PHP · Laravel · JavaScript · Vue.js',
                'Node.js · Python',
                'PostgreSQL · SQL Server · MySQL',
                'Docker · AWS',
                'APIs REST · SOAP',
            ],
        },
        experience: {
            eyebrow: 'Experiencia',
            heading: 'Una trayectoria enfocada en aplicaciones empresariales.',
            items: [
                {
                    company: 'CRONOS LOGISTICS',
                    role: 'Desarrollador Back-end Python | Desarrollo Full Stack',
                    period: 'Feb. 2026 - Actualidad',
                    location: 'Medellín, Antioquia - Híbrido',
                    summary:
                        'Desarrollo de soluciones web y back-end, automatización de procesos de cotización logística, PostgreSQL, Docker y desarrollo asistido por inteligencia artificial.',
                },
                {
                    company: 'MANPOWERGROUP',
                    role: 'Analista de software',
                    period: 'Oct. 2022 - Ene. 2026',
                    location: 'Medellín, Antioquia - Híbrido',
                    summary:
                        'Desarrollo y mantenimiento de aplicaciones empresariales con PHP, Laravel, JavaScript, Vue.js y Node.js; integraciones REST y SOAP; SQL Server, MySQL y soporte productivo.',
                },
                {
                    company: 'MANPOWERGROUP',
                    role: 'Practicante de desarrollo de software',
                    period: 'Mar. 2022 - Sept. 2022',
                    location: 'Colombia',
                    summary:
                        'Desarrollo web con PHP, Laravel y JavaScript, implementación de funcionalidades, solución de incidencias, consultas de datos y colaboración mediante Git.',
                },
            ],
        },
        projects: {
            eyebrow: 'Proyectos',
            heading: 'Soluciones donde el código produjo resultados medibles.',
            privateLabel:
                'Proyecto profesional privado. Información presentada sin datos confidenciales.',
            noRepositoryLabel: 'Repositorio no disponible públicamente.',
            repositoryLabel: 'Ver repositorio',
            newTabLabel: 'abre en una pestaña nueva',
        },
        education: {
            eyebrow: 'Formación',
            heading: 'Educación',
            items: [
                {
                    institution: 'CESDE',
                    program: 'Técnico laboral en Desarrollo de Software',
                    period: '2022',
                },
                {
                    institution: 'UNIREMINGTON',
                    program: 'Tecnología en Desarrollo de Software',
                    period: 'En formación',
                },
            ],
        },
        contact: {
            eyebrow: 'Contacto',
            heading: '¿Hablamos sobre una oportunidad?',
            description:
                'Escríbeme si tienes un proyecto, una vacante o una idea en la que podamos trabajar juntos.',
            honeypotLabel: 'Empresa',
            nameLabel: 'Nombre',
            emailLabel: 'Correo',
            subjectLabel: 'Asunto',
            messageLabel: 'Mensaje',
            messageHelp: 'Cuéntame brevemente el contexto de tu mensaje.',
            privacyConsentPrefix:
                'Autorizo el tratamiento de mis datos personales conforme a la',
            privacyConsentLink: 'Política de tratamiento de datos personales',
            privacyConsentSuffix:
                'para responder y realizar seguimiento a mi consulta.',
            errorsTitle: 'Revisa los campos del formulario',
            errorsDescription:
                'No pudimos enviar el mensaje. Corrige los siguientes campos:',
            successMessage:
                'Gracias por escribirme. Tu mensaje fue enviado correctamente.',
            sendingLabel: 'Enviando…',
            submitLabel: 'Enviar mensaje',
            toastTitle: 'Mensaje enviado',
            toastDescription:
                'Gracias por escribirme. Te responderé lo antes posible.',
        },
        footer: {
            builtWith: 'Construido con Laravel y Vue.js',
            navigationLabel: 'Enlaces del pie de página',
            newTabLabel: 'abre en una pestaña nueva',
            administrationLabel: 'Administración',
            privacyLabel: 'Privacidad',
            termsLabel: 'Términos y condiciones',
        },
    },
    en: {
        skipToContent: 'Skip to content',
        header: {
            navigationLabel: 'Main navigation',
            mobileNavigationLabel: 'Mobile navigation',
            homeLabel: 'Go to the top of the page',
            menuLabel: 'Open navigation menu',
            closeMenuLabel: 'Close navigation menu',
            languageLabel: 'Select language',
            navigation: {
                about: 'About',
                experience: 'Experience',
                projects: 'Projects',
                contact: 'Contact',
            },
        },
        hero: {
            eyebrow: 'Mid-Senior Full Stack Developer',
            headline: 'I build web solutions that improve',
            headlineHighlight: 'real-world processes.',
            introduction:
                'I am Mateo, a developer specializing in PHP, Laravel, JavaScript, and Vue.js. I turn business needs into maintainable applications, integrations, and automations.',
            location: 'Sabaneta, Antioquia, Colombia',
            viewProjects: 'View projects',
            downloadCv: 'Download CV',
            downloadCvLabel: 'Download Mateo Quintero’s CV in Spanish as a PDF',
            linkedInNewTab: 'opens in a new tab',
            portraitAlt: 'Professional portrait of Mateo Quintero Zapata',
        },
        achievements: {
            label: 'Highlighted professional results',
            items: [
                {
                    value: '+600',
                    label: 'users adopted the reporting solution',
                },
                {
                    value: '≈50%',
                    label: 'less time spent generating reports',
                },
                {
                    value: '≈40%',
                    label: 'improvement in response times after a migration',
                },
                {
                    value: 'More than 4 years',
                    label: 'of software development experience',
                },
            ],
        },
        about: {
            eyebrow: 'About',
            heading: 'Technical experience with business understanding.',
            description:
                'I have contributed to enterprise application development, process automation, and platform integration. My core strengths are Laravel and Vue.js, complemented by Node.js, Python, Docker, and relational databases.',
            technologiesLabel: 'Primary and complementary technologies',
            technologies: [
                'PHP · Laravel · JavaScript · Vue.js',
                'Node.js · Python',
                'PostgreSQL · SQL Server · MySQL',
                'Docker · AWS',
                'REST APIs · SOAP',
            ],
        },
        experience: {
            eyebrow: 'Experience',
            heading: 'A career focused on enterprise applications.',
            items: [
                {
                    company: 'CRONOS LOGISTICS',
                    role: 'Python Back-end Developer | Full Stack Development',
                    period: 'Feb. 2026 - Present',
                    location: 'Medellín, Antioquia - Hybrid',
                    summary:
                        'Development of web and back-end solutions, automation of logistics quotation processes, PostgreSQL, Docker, and AI-assisted development.',
                },
                {
                    company: 'MANPOWERGROUP',
                    role: 'Software Analyst',
                    period: 'Oct. 2022 - Jan. 2026',
                    location: 'Medellín, Antioquia - Hybrid',
                    summary:
                        'Development and maintenance of enterprise applications with PHP, Laravel, JavaScript, Vue.js, and Node.js; REST and SOAP integrations; SQL Server, MySQL, and production support.',
                },
                {
                    company: 'MANPOWERGROUP',
                    role: 'Software Development Intern',
                    period: 'Mar. 2022 - Sept. 2022',
                    location: 'Colombia',
                    summary:
                        'Web development with PHP, Laravel, and JavaScript; feature implementation; incident resolution; data queries; and collaboration using Git.',
                },
            ],
        },
        projects: {
            eyebrow: 'Projects',
            heading: 'Solutions where code delivered measurable results.',
            privateLabel:
                'Private professional project. Presented without confidential information.',
            noRepositoryLabel: 'Repository not publicly available.',
            repositoryLabel: 'View repository',
            newTabLabel: 'opens in a new tab',
        },
        education: {
            eyebrow: 'Education',
            heading: 'Education',
            items: [
                {
                    institution: 'CESDE',
                    program:
                        'Vocational Technical Program in Software Development',
                    period: '2022',
                },
                {
                    institution: 'UNIREMINGTON',
                    program: 'Software Development Technology Program',
                    period: 'In progress',
                },
            ],
        },
        contact: {
            eyebrow: 'Contact',
            heading: 'Shall we discuss an opportunity?',
            description:
                'Contact me if you have a project, an open position, or an idea we could work on together.',
            honeypotLabel: 'Company',
            nameLabel: 'Name',
            emailLabel: 'Email',
            subjectLabel: 'Subject',
            messageLabel: 'Message',
            messageHelp: 'Briefly tell me the context of your message.',
            privacyConsentPrefix:
                'I authorize the processing of my personal data under the',
            privacyConsentLink: 'Personal Data Processing Policy',
            privacyConsentSuffix: 'to respond to and follow up on my inquiry.',
            errorsTitle: 'Review the form fields',
            errorsDescription:
                'We could not send the message. Correct the following fields:',
            successMessage:
                'Thank you for reaching out. Your message was sent successfully.',
            sendingLabel: 'Sending…',
            submitLabel: 'Send message',
            toastTitle: 'Message sent',
            toastDescription:
                'Thank you for reaching out. I will get back to you as soon as possible.',
        },
        footer: {
            builtWith: 'Built with Laravel and Vue.js',
            navigationLabel: 'Footer links',
            newTabLabel: 'opens in a new tab',
            administrationLabel: 'Administration',
            privacyLabel: 'Privacy',
            termsLabel: 'Terms and Conditions',
        },
    },
};
