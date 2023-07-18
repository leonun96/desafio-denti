<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingresos;
use App\Models\Egresos;

class CoreController extends Controller
{
	public function index ()
	{
		$ingresos = (new Ingresos)->sumaMensual();
		$egresos = (new Egresos)->sumaMensual();

		return view('web.index',
			['ingresos' => $ingresos,'egresos' => $egresos]
		);
	}
	public function api ()
	{
		$ingresos = (new Ingresos)->sumaMensual();
		$egresos = (new Egresos)->sumaMensual();
		return response(['ingresos' => $ingresos,'egresos' => $egresos]);
	}
}
