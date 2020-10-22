<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

                return Inertia::render("Home/Game", ['usuario' => $usuario]);

            } else {

                return redirect('/home');

            }

        } else {

            return redirect('/home');

        }
        
    }
    public function register($dni, $ntable)
    {

        if (!$dni) {
            return redirect('/home');
        }

        $user = Data::where('dni', $dni)->first();

        if (!$user or !$ntable) {
            return redirect('/home');
        }

        $user->number_table = $ntable;
        $user->updated_at = date("Y-m-d H:i:s");
        $user->save();

        return "OK";

    }
}
