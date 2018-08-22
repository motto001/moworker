<?php

namespace Tests\Unit\controllerm;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route as RouteF;

use Illuminate\Support\Facades\Session;
class CrudTest extends TestCase
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
    public function testStore()
    {  
       // App\Http\Controllers\controllerM
       ///App\Http\Controllers\controllerM\testHandler  
        \Route::resource('test1', '\controllerM\testHandler\CrudTestController');
        Session::start();
    $response = $this->call('POST', 'test1', array(
        '_token' => csrf_token(),
    ));
   // $this->assertEquals(302, $response->getStatusCode());
        $ControllerM  =  \App::make('App\Http\Controllers\controllerM\testHandler\CrudTestController');
        $task=$ControllerM->getPar('base.actualTask');
        $this->assertTrue($task =='store');
    }
 
}
