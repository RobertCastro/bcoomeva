<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Ramsey\Uuid\Type\Integer;

class ProjectController extends Controller
{
    public function index()
    {
        if (! session()->has("search")) {
            session()->put("search", null);
            session()->put("trashed", null);
        }

        return Inertia::render("Projects/Index", [
            "filters" => session()->only(["search", "trashed"]),
            "projects" => Project::with("user")
                ->orderByDesc("id")
                ->filter(request()->only("search", "trashed"))
                ->paginate(5)
        ]);
    }

    public function create() 
    {
        return Inertia::render("Projects/Create");
    }

    public function store() 
    {
        Project::create(
            $this->validate(request(), [
                "name" => "required|unique:projects",
                "excerpt" => "required|min:10|max:200",
                "content" => "required|min:10|max:1000",
            ])
        );

        return redirect()->route('projects.index')->with('success', '¡Proyecto creado!');

    }
}
