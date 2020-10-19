<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DataController extends Controller
{
    public function index()
    {
        if (!session()->has("search")) {
            session()->put("search", null);
            session()->put("trashed", null);
        }
        return Inertia::render("Dashboard/Index", [
            "filters" => session()->only(["search", "trashed"]),
            "datos" => Data::where('number_table','<>', '',)
            // ->orderByDesc("id")
                ->filter(request()->only("search", "trashed"))
                ->paginate(20),
        ]);
    }
}
