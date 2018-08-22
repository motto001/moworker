<?php

namespace App\Http\Controllers\controllerM;

use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Route as RouteF;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use  Response;
class ControllerM extends Controller
{
/**
 * A view-el megosztott ,kívülről elérhetőparaméterek
 */
    public $PAR = [
        'base' =>
        [
            'routes' => ['base' => 'worker/naptar'],
            'cim' => 'Dolgozói Naptár', // TODO:többnyelvűsíteni!

        ],
        'index' =>
        [
            'cim' => 'Naptár',
            'calendar' => [
                'checkbutton' => false,
                'ev_ho_formopen' => true,
                'ev_ho_form_method' => 'GET',
            ],
        ],
    ];
/**
 * A controller által használt paraméterek
 */
    protected $BASE = [
        // 'search_column'=>'daytype_id,datum,managernote,usernote',
        'base' =>
        [ 
            //'allowedTask' => [], 
           // 'get' => ['ev' => null, 'ho' => null], //a  set_urlParams automatikusan fltölti a getből a $this->PAR['urlParams']-be
           // 'post_to_getT' => ['ev' => null, 'ho' => null], //a set_urlParams automatikusan fltölti a postból a $this->PAR['urlParams']-be
        ],
        'index' =>
        [

        ],
    ];
/**
 * A vew-nek átadott adatok
 */
    protected $DATA = [];

    public function __construct()
    {
        $this->setTask(RouteF::current());    
   
        }

    /**
     * Routot ráírányítva a paraméterben megadott függvényt hívja meg Hogy ne kelljen minden függvényhez routot csinálni
     *  @return void
     */
    public function taskRun($task){
        
        $general=$this->BASE['actual']['make'] ?? false;
        if( $general){
            $taskFunc = $this->PAR['base']['actualTask'] ; 
            $this->$taskFunc();
         }
        else{$this->taskMake();}  
    }
    public function taskRunWithId($task,$id){

        $this->PAR['actual']['id'] =$id;
        $general=$this->BASE['actual']['make'] ?? false;
        if( $general){
             $taskFunc = $this->PAR['base']['actualTask'] ;
            $this->$taskFunc($id); 
        }
       else{$this->taskMake();}  
    }
   
    public function taskMake($task){
       
        $localParams=[];
       
        foreach ($this->BASE['actual']['functions'] as $funtions)
        { 
            $params= $this->paramkMake($localParams,$functionParams);
            $function=$funtions[2];
            $key=$funtions[1];

            switch ($funtions[0]) {
                case 'BASE':
                setDot([$key=>$this->$function($params)], 'BASE');
                    break;
                case 'PAR':
                setDot([$key=>$this->$function($params)], 'PAR');
                    break;
                case 'DATA':
                setDot([$key=>$this->$function($params)], 'DATA');
                    break;
                case 'void':
                $this->$function($params);
                    break;
                case '$':
                $localParams[$key]=$this->$function($params);
                    break;  
                case 'return':
                return  $this->$function($params);
                    break;         
            }

        }
    }

    public function paramkMake($localParams,$functionParams){
        $params=[];
       
        foreach ($$functionParams as $key=>$pars)
        {
            
            switch ($pars[0]) {
                case 'BASE':
                $params[$key]=getBase($pars[1]);
                    break;
                case 'PAR':
                $params[$key]=getPar($pars[1]);
                    break;
                case 'DATA':
                $params[$key]=getData($pars[1]);
                    break;
                case 'local':
                $params[$key]=$localParams[$pars[1]];
                    break;  
                case 'str':
                    $params[$key]=$pars[1];
                     break;       
            }

        }
       return $params;
    }


    /**
     * Beállítja a PAR.base.actualtask és a PAR.base.viewtask értékét _construktor() hívja meg
     * @return void
     */
    public function setTask(Route $route)
    {
        $task = $route->getActionMethod();
       if ($task == 'taskRun') {$task = $route->parameter('task');}
      
        $allowedtask=$this->BASE['base']['allowedTask'] ?? config('controllerm.BASE.base.allowedTask') ?? [];
        $basetask=$this->PAR['base']['baseTask'] ?? config('controllerm.BASE.base.baseTask') ?? 'index'; 
        if(!in_array($task,$allowedtask)){
            $this->logM(['controllerM.taskChange','function not allowe:'. $task]); 
             $task= $basetask ;        
         }
      
         if(!method_exists($this, $task)){
            $this->logM(['controllerM.taskChange','function not exist:'. $task]); 
             $task=$basetask;           
         }
        $this->PAR['base']['actualTask'] = $task;
        $this->PAR['base']['viewTask'] = $this->BASE['base'][$task]['viewTask']  ?? $this->PAR['base']['viewTask'] ?? $task;

    }
  /**
     * _construktor() hívja meg a settask után
     * A setActualArr funkciónak be kell állítania A PAR és a BASE propertik actual kulcsú tümbjét
     *A BASE.base  tömböt egyesíti a Base.$task  ($task=PAR.base.actualTask) tömbel a BASE.actual tömbbe
     *A PAR.base  tömböt egyesíti a PAR.$viewtask  ($viewtask=PAR.base.actualViewTask) tömbel a PAR.actual tömbbe
     * @return void
     */
    public function setActualArr()
    {
        $task = $this->PAR['base']['actualtask'];
        $baseConf=config('controllerm.BASE') ?? [];
        $this->BASE= array_merge_recursive($baseConf, $this->BASE);
        $this->BASE['actual'] = array_merge_recursive($this->BASE['base'], $this->BASE[$task]);

        $viewTask = $this->PAR['base']['viewTask'];
        $parConf=config('controllerm.PAR') ?? [];
        $this->PAR= array_merge_recursive($parConf, $this->PAR);
        $this->PAR['actual'] = array_merge_recursivee($this->PAR['base'], $this->PAR[$viewTask]);

        $this->setTaskFunc();
    }

    /**
     * Kulcsok hozzáadása vagy törlése feltételek alapján vagy változókból,alapból üres az actualis controllerben kell felülírni
     */
    public function setTaskFunc(){}

    public function setView()
    {
        $data = $this->DATA ?? [];
        $viewParam = $this->PAR ?? [];

        $task = PAR['base']['actualtask'] ?? 'index';
        $viewtask =$this->PAR['base']['viewTask'] ?? $task;

        $template = $this->PAR['actual']['template'] ?? $this->PAR['template'] ?? config('controllerm.template') ?? '';
        $viewPath = $this->PAR[$viewtask]['viewPath'] ?? $this->PAR['viewPath'] ?? 'crudbase.base';
        return  $this->PAR[$viewtask]['fullViewPath'] ?? $this->PAR['fullViewPath'] ?? $template . '.' . $viewPath;


    }
    public function viewJson($data=[])
    {
   if(empty($data)){$data=$this->DATA;}
  // $data['csrfToken']  = csrf_token();
     return response()->json($data);
      //  return response()->json($data,200, ['Content-type'=> 'application/json; charset=utf-8'], JSON_UNESCAPED_UNICODE);

    }

    public function viewM()
    {
    
        $fullViewPath =$this->setView();
        return view($fullViewPath, compact(['data', 'viewParam']));

    }

    //handlerek--------------------------------------------------
         public function logM($errT){}
    //getteek setterek-----------------------------------------
        public function setDot($dotkeyArr, $propName)
        {
            foreach ($dotkeyArr as $dotkey => $value) {
                array_set($this->$propName, $dotkey, $value);
            }
        }
        public function setArr($arr, $propName)
        {
            array_merge($this->$propName, $arr);
        }
        public function delDot($dotkeyArr, $propName)
        {
            foreach ($dotkeyArr as $dotkey) {
                array_forget($this->$propName, $dotkey);
            }
        }
        public function getDot( $dotkey,$propName)
        {
                return   array_get($this->$propName, $dotkey);
        }
        public function getBase($dotkey)
        {
                return   array_get($this->BASE, $dotkey);
        }
        public function getPar($dotkey)
        {
                return   array_get($this->PAR, $dotkey);
        }
        public function getData($dotkey)
        {
                return   array_get($this->DATA, $dotkey);
        }
        public function hasDot($dotkey,$propName)
        {
                return  array_has($this->$propName, $dotkey);
        }
}
