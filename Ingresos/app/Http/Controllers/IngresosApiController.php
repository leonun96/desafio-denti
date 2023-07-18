<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;

class IngresosApiController extends Controller
{
	public function index ()
	{
		$ingresos = Ingresos::orderBy('fecha', 'desc')->get();
		return response()->json($ingresos, 200);
		// return response()->json(['ingresos' => $ingresos], 200);
	}
	public function store (Request $request)
	{
		$val = $request->validate([
			'fecha' => 'required',
			'monto' => ['required', 'min:1', 'numeric'],
		]);
		$ingreso = Ingresos::create($val);
		return response()->json(['ingreso' => $ingreso], 200);
	}
	public function delete (Request $request, $id)
	{
		// dd($id, $request);
		$ingreso = Ingresos::findOrFail($id);
		$ingreso->delete();
		return response()->json(['mensaje' => 'Registro eliminado correctamente'], 200);


	}
}
