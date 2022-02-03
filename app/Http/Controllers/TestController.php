<?php

namespace App\Http\Controllers;

use App\Models\Airline;
use App\Models\Airport;
use App\Models\Remark;
use Illuminate\Http\Request;

class TestController extends Controller
{
    //

    public function test(){

        // $airline = Airport::find(12);
        $airport = Airline::create(['code' => 1234,'name' => 'Aviacsa','city' => 'chetumal']);

        $remark = new Remark();
        $remark->description = 'Hola mundo 1';

        $airport->remarks()->save($remark);

        return $airport->remarks;




        
    }
}
