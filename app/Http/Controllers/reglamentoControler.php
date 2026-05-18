<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reglamento;

class reglamentoControler extends Controller
{

    public function subir_reglamento(Request $request)
    {
        $request->validate([
            'archivo' => 'required|file|max:10240',
        ]);

        $ruta = $request->file('archivo')->store('public');

        $reglamento = new Reglamento();
        $reglamento->ruta_reglamento = $ruta;
        $reglamento->save();

        return back()->with('success', 'Reglamento subido correctamente');
    }

}
