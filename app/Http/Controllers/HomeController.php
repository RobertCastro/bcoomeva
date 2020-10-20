<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render("Home/Index");
    }

    public function store(Request $request)
    {
        if ($request->has('dni')) {

                $search = $request->get('dni');
                $user = Data::where('dni', 'like', '%' . $search . '%')->first();
                if ($user) {
                    return Inertia::render("Home/Index", ['user' => $user]);
                } else {
                    return Inertia::render("Home/Index", ['msg' => "No se ha encontrado usuario"]);
                }
                

            
        }
    }
}
