<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;

class IngresosController extends Controller
{
    public function index ()
    {
        $ingresos = Ingresos::orderBy('fecha', 'desc')->get();
        return view('web.ingresos', ['ingresos' => $ingresos]);
    }
    public function store (Request $request)
    {
        $val = $request->validate([
			'fecha' => 'required',
			'monto' => ['required', 'min:1', 'numeric'],
		]);
		Ingresos::create($val);
		return redirect()->route('ingreso.index');
    }
    public function delete (Request $request, $id)
    {
        // dd($id, $request);
        $ingreso = Ingresos::findOrFail($id);
        $ingreso->delete();
        return redirect()->route('ingreso.index');
    }
}
