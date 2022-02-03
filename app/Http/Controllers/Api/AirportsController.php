<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Airports\AirportRequest;
use App\Models\Airport;
use Exception;
use Illuminate\Http\Request;

class AirportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $airports = Airport::all();
        return response()->json($airports);

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
    public function store(AirportRequest $request)
    {
        //
        try{
            Airport::create($request->only(['name','code','city']));

            return response()->json([
                'success' => true,
                'msg' => 'Se ha agregado correctamente'
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
    public function edit(AirportRequest $request, Airport $airport)
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
    public function update(AirportRequest $request, Airport $airport)
    {
        //
        try{

            $airport->update($request->only(['name','code','city']));

            return response()->json([
                'success' => true,
                'msg' => 'Se ha actualizado correctamente'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error al actualizar'
            ],500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Airport $airport)
    {
        //
        try{

            $airport->delete();

            return response()->json([
                'success' => true,
                'msg' => 'Se ha eliminado correctamente'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error al eliminar'
            ],500);
        }
    }
}
