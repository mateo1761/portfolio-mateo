export type Experience = {
    id: number;
    company: string;
    role_es: string;
    role_en: string;
    period_es: string;
    period_en: string;
    location_es: string;
    location_en: string;
    summary_es: string;
    summary_en: string;
    is_published: boolean;
    sort_order: number;
};

export type PublicExperience = {
    id: number;
    company: string;
    role: string;
    period: string;
    location: string;
    summary: string;
};
