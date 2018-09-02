<?php

namespace Tests\Unit\controllerm;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as RouteF;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\controllerM\ControllerM;
use  Response;

class CrudTestController extends ControllerM
{

    use \App\Http\Controllers\controllerM\testHandler\Crud;

}