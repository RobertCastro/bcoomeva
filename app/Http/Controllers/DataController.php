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

    public function store(Request $request)
    {

        // $req->validate([
        //     'file' => 'required|mimes:csv|max:2048'
        // ]);

        $image = $request->file("logo");

        if ($image) {
            $fileName =  $image->getClientOriginalName();

            // error_log($fileName);

            var_dump($fileName);

            
        }

        

        // return redirect()->route('dashboard.index')->with('success', $image.toS);

    }
}
