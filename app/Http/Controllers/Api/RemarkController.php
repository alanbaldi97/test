<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RemarksRequest;
use App\Models\Airline;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Remark;
use Exception;
use Illuminate\Http\Request;

class RemarkController extends Controller
{
    //

    public function getRemarks( $id, $type  ){
        $remarks = [];

        if($type == 'flights'){
            $flight = Flight::find($id);
            $remarks = $flight->remarks;
        }else if($type == 'airlines'){
            $airline = Airline::find($id);
            $remarks = $airline->remarks;
        }else if($type == 'airports'){
            $airport = Airport::find($id);
            $remarks = $airport->remarks;
        }

        return response()->json($remarks);
    }

    public function create(RemarksRequest $request,  $id, $type  ){

        try{

            $remark = new Remark();
            $remark->description = $request->input('description');
            
            if($type == 'flights'){
                $flight = Flight::find($id);
                $flight->remarks()->save($remark);
            }else if($type == 'airlines'){
                $airline = Airline::find($id);
                $airline->remarks()->save($remark);
            }else if($type == 'airports'){
                $airport = Airport::find($id);
                $airport->remarks()->save($remark);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Se ha agregado el registro'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error'
            ]);
        }
    }

    public function update( RemarksRequest $request, Remark $remark ){
        try{
            $remark->update($request->only([
                'description',
            ]));

            return response()->json([
                'success' => true,
                'msg' => 'Se ha actualizado el registro'
            ]);

        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'msg' => 'Lo sentimos ocurrio un error al actualizar'
            ],500);
        }
    }

    public function delete( Remark $remark  ){
        try{
            $remark->delete();
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
