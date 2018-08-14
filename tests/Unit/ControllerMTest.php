<?php

namespace Tests\Unit;

use Tests\TestCase;

class ControllerMTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $data = []; $viewParam = [];
        $makeview = \View::make('Bootstrap3.dashgum.crudbase.proba', compact(['data', 'viewParam']));
        $view = $makeview->render();

        $class = \App::make('App\Http\Controllers\ControllerM');
        $viewM = $class->viewM(['fullViewPath' => 'Bootstrap3.dashgum.crudbase.proba']);
        $this->assertTrue($viewM == $view);
        $viewM = $class->viewM(['template' => 'Bootstrap3.dashgum','viewPath' => 'crudbase.proba']);
        $this->assertTrue($viewM== $view);
    }

}
