<?php

namespace Tests\Unit\controllerm;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route as RouteF;

use Illuminate\Support\Facades\Session;
class MakeTest extends TestCase
{  

/*
  public function testCreate()
    {    
        \Route::resource('test1', 'ControllerM');
        $response = $this->get('/test1/create');
        $ControllerM  =  \App::make('App\Http\Controllers\ControllerM');
        $task=$ControllerM->getPar('base.actualTask');
        $this->assertTrue($task =='create');
    }
 */  
    public function testMakeParam()
    {  
        \Route::resource('test1', 'ControllerM');
        $response = $this->get('/test1');
        $ControllerM  =  \App::make('App\Http\Controllers\controllerM\testHandler\CrudTestController');
        $localParams=['local1'=>'localvalue1','local2'=>'localvalue2'];
        $ControllerM->setDot(['base.base1'=>'baseval1'], 'BASE');
        $ControllerM->setDot(['base.par1'=>'parval1'], 'PAR');
        $ControllerM->setDot(['base.data1'=>'dataval1'], 'DATA');
        $functionParams=['local1'=>['local','local1'],'par1'=>['PAR','base.par1']]; 
        $pars=$ControllerM->paramMake($localParams,$functionParams);
        $this->assertEquals($pars, ['local1'=>'localvalue1','par1'=>'parval1']);
       // $this->assertTrue($task =='store');
    }
 
}
