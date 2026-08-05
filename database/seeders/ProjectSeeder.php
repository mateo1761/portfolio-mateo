<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->projects() as $project) {
            Project::query()->firstOrCreate([
                'title_es' => $project['title_es'],
            ], $project);
        }
    }

    /**
     * Get the verified initial portfolio projects.
     *
     * @return array<int, array<string, bool|int|string|null>>
     */
    private function projects(): array
    {
        return [
            [
                'title_es' => 'Sistema de reportes dinámicos',
                'title_en' => 'Dynamic reporting system',
                'category_es' => 'Sistema empresarial · Proyecto privado',
                'category_en' => 'Enterprise system · Private project',
                'description_es' => 'Plataforma utilizada por más de 600 usuarios que redujo aproximadamente un 50% el tiempo de generación de informes mediante filtros avanzados y conexiones dinámicas con bases de datos.',
                'description_en' => 'A platform used by more than 600 users that reduced report generation time by approximately 50% through advanced filters and dynamic database connections.',
                'technologies_es' => 'Laravel · Vue.js · SQL Server · APIs',
                'technologies_en' => 'Laravel · Vue.js · SQL Server · APIs',
                'repository_url' => null,
                'is_private' => true,
                'is_published' => true,
                'sort_order' => 10,
            ],
            [
                'title_es' => 'Cotización y procesamiento inteligente',
                'title_en' => 'Intelligent quotation and processing',
                'category_es' => 'Logística · Automatización',
                'category_en' => 'Logistics · Automation',
                'description_es' => 'Solución enfocada en transformar necesidades operativas del sector logístico en procesos digitales mantenibles, contenerizados e integrados con datos empresariales.',
                'description_en' => 'A solution focused on turning operational logistics needs into maintainable, containerized digital processes integrated with enterprise data.',
                'technologies_es' => 'Python · PostgreSQL · Docker · IA aplicada',
                'technologies_en' => 'Python · PostgreSQL · Docker · Applied AI',
                'repository_url' => null,
                'is_private' => true,
                'is_published' => true,
                'sort_order' => 20,
            ],
            [
                'title_es' => 'Portafolio Mateo',
                'title_en' => 'Portafolio Mateo',
                'category_es' => 'Proyecto personal · Código público',
                'category_en' => 'Personal project · Public source code',
                'description_es' => 'Portafolio profesional desarrollado con Laravel 13, Vue 3 e Inertia, con PostgreSQL, Docker, Laravel Sail, Nginx, HTTPS local, autenticación TOTP, correo y CI/CD.',
                'description_en' => 'A professional portfolio built with Laravel 13, Vue 3, and Inertia, featuring PostgreSQL, Docker, Laravel Sail, Nginx, local HTTPS, TOTP authentication, email, and CI/CD.',
                'technologies_es' => 'Laravel 13 · Vue 3 · Inertia · PostgreSQL · Docker',
                'technologies_en' => 'Laravel 13 · Vue 3 · Inertia · PostgreSQL · Docker',
                'repository_url' => 'https://github.com/mateo1761/portfolio-mateo',
                'is_private' => false,
                'is_published' => true,
                'sort_order' => 30,
            ],
        ];
    }
}
