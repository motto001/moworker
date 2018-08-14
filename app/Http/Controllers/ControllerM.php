<?php

namespace App\Http\Controllers;

class ControllerM extends Controller
{

    protected $PAR = [

        'routes' => ['base' => 'worker/naptar'],
        'cim' => 'Dolgozói Naptár', // TODO:többnyelvűsíteni!

        'viewtask' =>
        [
            'index' =>
            [
                'cim' => 'Naptár',
                'calendar' => [
                    'checkbutton' => false,
                    'ev_ho_formopen' => true,
                    'ev_ho_form_method' => 'GET',
                ],
            ],
            /*   'create'=>[], */
        ],

    ];

    protected $BASE = [
        // 'search_column'=>'daytype_id,datum,managernote,usernote',
        'get' => ['ev' => null, 'ho' => null], //a  set_getT automatikusan fltölti a getbőll a $this->PAR['getT']-be
        'post_to_getT' => ['ev' => null, 'ho' => null], //a set_getT automatikusan fltölti a postból a $this->PAR['getT']-be

        'index' =>
        [

        ],

    ];
    protected $DATA = [];
    
    public function ViewM($par=[])
    {    
        $data = $this->DATA ?? [];
        $viewParam = $this->PAR ?? [];

        $task = $this->BASE['task'] ?? 'index';
        $viewtask =$par['viewtask'] ??  $this->BASE[$task]['viewtask'] ?? 'index';

        $template=$par['template'] ?? $this->PAR['template'] ?? config('app.template') ?? '';
        $viewPath =$par['viewPath'] ??  $this->PAR['crudbase'] ?? $this->PAR['viewtask'][$viewtask]['crudbase'] ?? 'crudbase.base';
        $fullViewPath =$par['fullViewPath'] ?? $template . '.' . $viewPath;

        return view($fullViewPath,compact(['data', 'viewParam']));
    }
}
