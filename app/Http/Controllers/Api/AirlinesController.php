<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Airlines\AirlineRequest;
use App\Models\Airline;
use Exception;
use Illuminate\Http\Request;

class AirlinesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $airlines = Airline::all();
        return response()->json($airlines);
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
    public function store(AirlineRequest $request)
    {
        //
        try{
            Airline::create($request->only(['name','code']));

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
    public function update(AirlineRequest $request, Airline $airline)
    {
        //

        try{

            $airline->update($request->only(['name','code']));

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
    public function destroy(Airline $airline)
    {
        //

        try{
            $airline->delete();

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
