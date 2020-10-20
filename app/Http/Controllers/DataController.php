<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Imports\DataImport;
use Maatwebsite\Excel\Facades\Excel;

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

        // $csv = $request->file("csv");

        // Excel::import(new DataImport, $csv);

        

        $path1 = $request->file('csv')->store('temp');
        $path = storage_path('app') . '/' . $path1;
        $data = Excel::import(new DataImport, $path);

        return redirect()->route('dashboard.index')->with('success', "Importado!");

        // $image = $request->file("logo");

        // if ($image) {
        //     $fileName =  $image->getClientOriginalName();
        //     var_dump($fileName);
        // }

        // return redirect()->route('dashboard.index')->with('success', $image.toS);

    }
}
