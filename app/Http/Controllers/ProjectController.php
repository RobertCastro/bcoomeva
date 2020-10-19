<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index() {
        if ( ! session()->has("search")) {
            session()->put("search", null);
            session()->put("trashed", null);
        }
        return Inertia::render("Projects/Index", [
            "filters" => session()->only(["search", "trashed"]),
            "projects" => Project::with("user")
                ->orderByDesc("id")
                ->filter(request()->only("search", "trashed"))
                ->paginate(5),
        ]);
    }

    public function create() {
        return Inertia::render("Projects/Create");
    }

    public function store() {
        Project::create(
            $this->validate(request(), [
                "name" => "required|unique:projects",
                "excerpt" => "required|min:10|max:200",
                "content" => "required|min:10|max:1000",
            ])
        );

        return redirect()->route('projects.index')->with('success', '¡Proyecto creado!');
    }

    public function edit(Project $project) {
        return Inertia::render('Projects/Edit', [
            'project' => [
                'id' => $project->id,
                'name' => $project->name,
                'excerpt' => $project->excerpt,
                'content' => $project->content,
                'deleted_at' => $project->deleted_at
            ]
        ]);
    }

    public function update(Project $project) {
        $project->update(
            $this->validate(request(), [
                "name" => "required|unique:projects,name," . $project->id,
                "excerpt" => "required|min:10|max:200",
                "content" => "required|min:10|max:1000",
            ])
        );

        return redirect()->route('projects.index')->with('success', '¡Proyecto actualizado!');
    }

    public function destroy(Project $project) {
        $project->delete();
        return redirect()->route('projects.index')->with('success', '¡Proyecto eliminado!');
    }
}
