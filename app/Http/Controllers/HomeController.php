<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): Response
    {
        $locale = $request->route('locale') === 'en' ? 'en' : 'es';

        return Inertia::render('Welcome', [
            'locale' => $locale,
            'seo' => $this->seo($locale),
            'projects' => $this->publicProjects($locale),
        ]);
    }

    /**
     * Get the localized public project data.
     *
     * @return array<int, array<string, bool|int|string|null>>
     */
    private function publicProjects(string $locale): array
    {
        /** @var Collection<int, Project> $projects */
        $projects = Project::query()->published()->ordered()->get();

        return $projects->values()->map(fn (Project $project, int $index): array => [
            'id' => $project->id,
            'number' => str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT),
            'category' => $locale === 'en' ? $project->category_en : $project->category_es,
            'title' => $locale === 'en' ? $project->title_en : $project->title_es,
            'description' => $locale === 'en' ? $project->description_en : $project->description_es,
            'technologies' => $locale === 'en' ? $project->technologies_en : $project->technologies_es,
            'private' => $project->is_private,
            'url' => $project->repository_url,
        ])->all();
    }

    /**
     * Get localized homepage metadata.
     *
     * @return array{title: string, description: string}
     */
    private function seo(string $locale): array
    {
        if ($locale === 'en') {
            return [
                'title' => 'Mateo Quintero Zapata | Full Stack Developer | Portafolio Mateo',
                'description' => 'Mid-Senior Full Stack Developer specializing in PHP, Laravel, JavaScript, and Vue.js, with experience in enterprise applications, integrations, and process automation.',
            ];
        }

        return [
            'title' => 'Mateo Quintero Zapata | Desarrollador Full Stack | Portafolio Mateo',
            'description' => 'Desarrollador Full Stack Mid-Senior especializado en PHP, Laravel, JavaScript y Vue.js, con experiencia en aplicaciones empresariales, integraciones y automatización de procesos.',
        ];
    }
}
