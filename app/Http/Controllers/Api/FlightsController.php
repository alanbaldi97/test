<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Flights\FlightsRequest;
use App\Models\Flight;
use Exception;
use Illuminate\Http\Request;

class FlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
     {
        $this->authorizeResource(Flight::class, 'flight');
     }


    public function index()
    {
        //
        $flights = Flight::with(['departure:id,name','destination:id,name', 'airline:id,name'])->get();

        return response()->json($flights);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlightsRequest $request)
    {
        //
        try{
            Flight::create($request->only([
                'code',
                'type',
                'departure_id',
                'destination_id',
                'departure_time',
                'arrival_time',
                'airline_id'
            ]));

            return response()->json([
                'success' => true,
                'msg' => 'Se ha agregado el registro'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error al insertar'
            ],500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FlightsRequest $request, Flight $flight)
    {
        //

        try{
            $flight->update($request->only([
                'code',
                'type',
                'departure_id',
                'destination_id',
                'departure_time',
                'arrival_time',
                'airline_id'
            ]));


            return response()->json([
                'success' => true,
                'msg' => 'Se ha actualizado el registro'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error al insertar'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flight $flight)
    {
        //
        try{
            $flight->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Se ha eliminado el registro'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error al eliminar'
            ],500);
        }
    }
}
