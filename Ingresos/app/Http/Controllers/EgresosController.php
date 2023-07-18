<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Egresos;

class EgresosController extends Controller
{
    public function index ()
    {
        $egresos = Egresos::orderBy('fecha', 'desc')->get();
        return view('web.egresos', ['egresos' => $egresos]);
    }
    public function store (Request $request)
    {
        $val = $request->validate([
			'fecha' => 'required',
			'monto' => ['required', 'min:1', 'numeric'],
		]);
		Egresos::create($val);
		return redirect()->route('egreso.index');
    }
    public function delete (Request $request, $id)
    {
        // dd($id, $request);
        $ingreso = Egresos::findOrFail($id);
        $ingreso->delete();
        return redirect()->route('egreso.index');
    }
}
