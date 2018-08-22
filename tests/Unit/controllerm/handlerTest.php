<?php

namespace Tests\Unit\controllerm;;

use Tests\TestCase;

class handlerTest extends TestCase
{

    public function testGetSet()
    {
        // \Route::any('test/taskChange/{task}', 'ControllerM@taskChange');
        $response = $this->call('GET', 'test/taskChange/setTaskTesthandler'); //kell hogy ne jelezzen hibát a construktorral meghívott setTask()
        $ControllerM = \App::make('App\Http\Controllers\ControllerM');
        //PAR set get has ----------------------
        $ControllerM->setDot(['Pegyes' => 'Pegyes', 'Pkettes.kettes' => 'Pkettes'], 'PAR');
        $this->assertTrue($ControllerM->PAR['Pegyes'] == 'Pegyes');
        $this->assertTrue($ControllerM->PAR['Pkettes']['kettes'] == 'Pkettes');
        $this->assertTrue($ControllerM->hasDot('Pkettes','PAR'));
        $this->assertTrue($ControllerM->getPar('Pkettes.kettes') == 'Pkettes');
        //BASE set get---------------------------
        $ControllerM->setDot(['Begyes' => 'Begyes', 'Bkettes.kettes' => 'Bkettes'], 'BASE');
        $this->assertTrue($ControllerM->getDot( 'Bkettes.kettes','BASE') == 'Bkettes');
        $this->assertTrue($ControllerM->getBase('Bkettes.kettes') == 'Bkettes');
        //DATA set get----------------------------
        $ControllerM->setDot(['Degyes' => 'Degyes', 'Dkettes.kettes' => 'Dkettes'], 'DATA');
        $this->assertTrue($ControllerM->getData('Dkettes.kettes') == 'Dkettes');
        //del---------------------------------
        $ControllerM->delDot(['Begyes', 'Bkettes.kettes'],'BASE' );
        $ControllerM->delDot(['Pegyes'],'PAR' );
        $this->assertTrue(!$ControllerM->hasDot('Bkettes.kettes','BASE'));
        $this->assertTrue(!$ControllerM->hasDot('Begyes','BASE'));
        $this->assertTrue(!$ControllerM->hasDot('Peggyes','PAR'));
        $this->assertTrue($ControllerM->hasDot('Pkettes.kettes','PAR'));

    }

}
