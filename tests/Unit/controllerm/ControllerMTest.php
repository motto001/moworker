<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route as RouteF;


class ControllerMTest extends TestCase
{  

    public function testsetTask()
    {    
 // létező funkció hívása, de a funkció nincs az allowedtask tömbnen,  behelyettesítés: BASE.base.baseTask-al (chBaseTask) 
      \Route::any('test/taskrun/{task}', 'ControllerM@taskRun');
        config(['controllerm.BASE.base.baseTask'=>'chBaseTask']) ;  //alapértelmezett task beállítás
        $response = $this->call('GET', 'test/taskrun/setTaskFunc');     //settaskFunc() üres funkció child írja felül
        $ControllerM = \App::make('App\Http\Controllers\ControllerM');     
        $ControllerM->setTask(RouteF::current());
        $this->assertTrue($ControllerM->PAR['base']['actualTask'] =='chBaseTask'); 

 // létező allowedtask tömbnen lévő funkció hívása.    
        $ControllerM->setDot(['base.allowedTask' =>['setTaskFunc']], 'BASE');  //allowedTask tömb beállítása
        $ControllerM->setTask(RouteF::current());
        $this->assertTrue($ControllerM->PAR['base']['actualTask'] =='setTaskFunc'); //meghívott funkció az actual task

// nem létező funkció hívása,behelyettesítés: BASE.base.baseTask-al (chBaseTask) 
        $response = $this->call('GET', 'test/taskrun/setTaskFunc2');     
        $ControllerM = \App::make('App\Http\Controllers\ControllerM');
        $ControllerM->setDot(['base.allowedTask' =>['setTaskFunc2']], 'BASE');
        $ControllerM->setTask(RouteF::current());
        $this->assertTrue($ControllerM->PAR['base']['actualTask'] =='chBaseTask');


    }

  
   
   public function testViewJson()
    {


       \Route::any('test1', 'ControllerM@setTaskFunc'); //settaskFunc() üres funkció child írja felül
       $response = $this->call('GET', 'test1');
  
       // $ControllerM  = app(\App\Http\Controllers\ControllerM::class)->viewJson( $data);
        $ControllerM  =  \App::make('App\Http\Controllers\ControllerM');
        $ControllerM->setDot(['egykey'=>'egyvalue'], 'DATA');
        $testRes = new \Illuminate\Foundation\Testing\TestResponse( $ControllerM->viewJson() );
      // $testRes->assertJson(...); // Will be available
     
       // dump($response);
        $testRes->assertJson([
            'egykey' =>'egyvalue',
        ]);
        $testRes = new \Illuminate\Foundation\Testing\TestResponse( $ControllerM->viewJson(['egykey2'=>'egyvalue']) );
        $testRes->assertJson([
            'egykey2' =>'egyvalue',
        ]);
    }
    /**
     * A viewM test:a funkciónak vezérelhetőnek kell lenie A PAR és a BASE propertik által
     *
     * @return void
     */ 

    
  //testhandlerek------------------------------------------------------


    public function createViews()
    {
        $viewPath=resource_path('views');

        if (!is_dir($viewPath.'/Proba/crudbase')) {
           \File::makeDirectory($viewPath.'/Proba/crudbase', 0755, true);
           \File::put($viewPath.'/Proba/crudbase/proba.blade.php','proba.proba');
           \File::put($viewPath.'/Proba/crudbase/base.blade.php','proba.base');
       
        }
        if (!is_dir($viewPath.'/crudbase')) {
            \File::makeDirectory($viewPath.'/crudbase', 0755, true); 
            \File::put($viewPath.'/crudbase/proba.blade.php','proba.');
            \File::put($viewPath.'/crudbase/base.blade.php','base');
        }
      

    }
    public function deleteViews()
    {
        $viewPath=resource_path('views');;
        \File::deleteDirectory($viewPath.'/Proba');
        \File::deleteDirectory($viewPath.'/crudbase');
    }
}
