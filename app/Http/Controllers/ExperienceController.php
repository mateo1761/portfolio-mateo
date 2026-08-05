<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreExperienceRequest;
use App\Http\Requests\UpdateExperienceRequest;
use App\Models\Experience;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Inertia\Response;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        Gate::authorize('viewAny', Experience::class);

        return Inertia::render('experiences/Index', [
            'experiences' => Experience::query()->ordered()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        Gate::authorize('create', Experience::class);

        return Inertia::render('experiences/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreExperienceRequest $request): RedirectResponse
    {
        Experience::query()->create($request->validated());
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Experience created.']);

        return to_route('experiences.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Experience $experience): Response
    {
        Gate::authorize('update', $experience);

        return Inertia::render('experiences/Edit', ['experience' => $experience]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateExperienceRequest $request, Experience $experience): RedirectResponse
    {
        $experience->update($request->validated());
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Experience updated.']);

        return to_route('experiences.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Experience $experience): RedirectResponse
    {
        Gate::authorize('delete', $experience);
        $experience->delete();
        Inertia::flash('toast', ['type' => 'success', 'message' => 'Experience deleted.']);

        return to_route('experiences.index');
    }
}
