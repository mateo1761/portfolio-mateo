<?php

namespace App\Http\Controllers;

use App\Actions\BuildDashboardAnalyticsAction;
use App\Models\Experience;
use App\Models\Project;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(BuildDashboardAnalyticsAction $buildAnalytics): Response
    {
        $projectSummary = Project::query()
            ->toBase()
            ->selectRaw('count(*) as total')
            ->selectRaw('count(case when is_published = true then 1 end) as published')
            ->selectRaw('count(case when is_published = false then 1 end) as drafts')
            ->first();

        $experienceSummary = Experience::query()
            ->toBase()
            ->selectRaw('count(*) as total')
            ->selectRaw('count(case when is_published = true then 1 end) as published')
            ->selectRaw('count(case when is_published = false then 1 end) as drafts')
            ->first();

        return Inertia::render('Dashboard', [
            'analytics' => $buildAnalytics->handle(),
            'contentSummary' => [
                'projects' => [
                    'total' => (int) $projectSummary->total,
                    'published' => (int) $projectSummary->published,
                    'drafts' => (int) $projectSummary->drafts,
                ],
                'experiences' => [
                    'total' => (int) $experienceSummary->total,
                    'published' => (int) $experienceSummary->published,
                    'drafts' => (int) $experienceSummary->drafts,
                ],
            ],
        ]);
    }
}
