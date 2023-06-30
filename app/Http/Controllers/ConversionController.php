<?php

namespace App\Http\Controllers;

use App\Models\Conversion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ConversionController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(string $actualizacion, float $usd, float $btc, float $precio_usd)
    {
        // Guardamos los datos en la base de datos
        $conversion = new Conversion();
        $conversion->ultima_actualizacion_btc = $actualizacion;
        $conversion->precio_usd = $precio_usd;
        $conversion->cantidad_usd = $usd;
        $conversion->cantidad_btc = $btc;
        $conversion->save();
    }

    public function conversion(Request $request) {
        // Llamamos a la api de coindesk para obtener el precio del bitcoin en USD
        $response = Http::get('https://api.coindesk.com/v1/bpi/currentprice/euro.json');
        // Decodificamos el json que nos devuelve la api
        $data = json_decode($response->getBody());
        // Obtenemos el precio del bitcoin en USD
        $precio_usd = $data->bpi->USD->rate_float;
        $satoshi = 0.00000001;
        // Calculamos el resultado según el tipo de moneda que nos envíen
        // Ademas si nos llega que el refresh es falso, significa que no es un llamado desde la funcion setInterval()
        // por lo tanto es una conversion y debemos guardarla en la base de datos.
        if ($request->type == 'usd'){
            $subtotal = $precio_usd * $satoshi;
            $totalBbit = $request->amount / $subtotal;
            $totalBtc = $totalBbit / 100000000;
            $resultado = $totalBtc;
            if ($request->refresh == false){
                $this->store($data->time->updated, $request->amount, $resultado, $precio_usd);
            }
        }
        if ($request->type == 'btc') {
            $totalBbit = $request->amount * 100000000;
            $totalUsd = $totalBbit * ($precio_usd * $satoshi);
            $resultado = $totalUsd;
            if ($request->refresh == false){
                $this->store($data->time->updated, $resultado, $request->amount, $precio_usd);
            }
        }
        // Retornamos el resultado
        return $resultado;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Conversion $conversion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Conversion $conversion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conversion $conversion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Conversion $conversion)
    {
        //
    }
}
