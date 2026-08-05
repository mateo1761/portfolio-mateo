<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->experiences() as $experience) {
            Experience::query()->firstOrCreate([
                'company' => $experience['company'],
                'role_es' => $experience['role_es'],
            ], $experience);
        }
    }

    /** @return array<int, array<string, bool|int|string>> */
    private function experiences(): array
    {
        return [
            [
                'company' => 'CRONOS LOGISTICS',
                'role_es' => 'Desarrollador Back-end Python | Desarrollo Full Stack',
                'role_en' => 'Python Back-end Developer | Full Stack Development',
                'period_es' => 'Feb. 2026 - Actualidad',
                'period_en' => 'Feb. 2026 - Present',
                'location_es' => 'Medellín, Antioquia - Híbrido',
                'location_en' => 'Medellín, Antioquia - Hybrid',
                'summary_es' => 'Desarrollo de soluciones web y back-end, automatización de procesos de cotización logística, PostgreSQL, Docker y desarrollo asistido por inteligencia artificial.',
                'summary_en' => 'Development of web and back-end solutions, automation of logistics quotation processes, PostgreSQL, Docker, and AI-assisted development.',
                'is_published' => true,
                'sort_order' => 10,
            ],
            [
                'company' => 'MANPOWERGROUP',
                'role_es' => 'Analista de software',
                'role_en' => 'Software Analyst',
                'period_es' => 'Oct. 2022 - Ene. 2026',
                'period_en' => 'Oct. 2022 - Jan. 2026',
                'location_es' => 'Medellín, Antioquia - Híbrido',
                'location_en' => 'Medellín, Antioquia - Hybrid',
                'summary_es' => 'Desarrollo y mantenimiento de aplicaciones empresariales con PHP, Laravel, JavaScript, Vue.js y Node.js; integraciones REST y SOAP; SQL Server, MySQL y soporte productivo.',
                'summary_en' => 'Development and maintenance of enterprise applications with PHP, Laravel, JavaScript, Vue.js, and Node.js; REST and SOAP integrations; SQL Server, MySQL, and production support.',
                'is_published' => true,
                'sort_order' => 20,
            ],
            [
                'company' => 'MANPOWERGROUP',
                'role_es' => 'Practicante de desarrollo de software',
                'role_en' => 'Software Development Intern',
                'period_es' => 'Mar. 2022 - Sept. 2022',
                'period_en' => 'Mar. 2022 - Sept. 2022',
                'location_es' => 'Colombia',
                'location_en' => 'Colombia',
                'summary_es' => 'Desarrollo web con PHP, Laravel y JavaScript, implementación de funcionalidades, solución de incidencias, consultas de datos y colaboración mediante Git.',
                'summary_en' => 'Web development with PHP, Laravel, and JavaScript; feature implementation; incident resolution; data queries; and collaboration using Git.',
                'is_published' => true,
                'sort_order' => 30,
            ],
        ];
    }
}
