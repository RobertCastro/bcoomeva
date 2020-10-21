<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use DateTime;
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

            $dni = $request->get('dni');
            $user = Data::where('dni', $dni)->first();

            if ($user) {

                $usuario = Data::where('dni',$request->get('dni'))->first();
                $key = $usuario->key;

                $rand = rand(111, 999).$key;
                return redirect('home/'.$rand. '/'. $dni.'/game')->with('key', $key);

            } else {

                return Inertia::render("Home/Index", ['msg' => "No se ha encontrado usuario"]);

            }
        }
    }

    public function game($rand, $dni) 
    {

        $key = substr($rand, 3, 10);

        $usuario = Data::where('dni', $dni)->first();
        if ($usuario) {

            $keyDB = $usuario->key;

            if ($key == $keyDB) {

                return Inertia::render("Home/Game");

            } else {

                return redirect('/home');

            }

        } else {

            return redirect('/home');

        }
        
    }
}
