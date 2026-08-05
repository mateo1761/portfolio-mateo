export type Project = {
    id: number;
    title_es: string;
    title_en: string;
    category_es: string;
    category_en: string;
    description_es: string;
    description_en: string;
    technologies_es: string;
    technologies_en: string;
    repository_url: string | null;
    is_private: boolean;
    is_published: boolean;
    sort_order: number;
};
