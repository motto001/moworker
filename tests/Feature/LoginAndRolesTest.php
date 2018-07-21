<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class LoginAndRolesTest extends TestCase
{
    /** @belépés és jogosultságok ellenőrzése */
    public function testLoginAndroles()
    {
        \Session::start();
        $response = $this->call('POST', '/login', [
            'email' => 'worker@dolgozo.com',
            'password' => 'aaaaaa',
            '_token' => csrf_token(),
        ]);
        //  $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals(Auth::id(), 5);
        $this->assertEquals(Auth::user()->hasRole('worker'), true);
        $this->assertEquals(Auth::user()->hasRole('manager'), false);
        $this->assertEquals(Auth::user()->hasRole('workadmin'), false);

        Auth::logout();
        $response = $this->call('POST', '/login', [
            'email' => 'manager@dolgozo.com',
            'password' => 'aaaaaa',
            '_token' => csrf_token(),
        ]);
        $this->assertEquals(Auth::id(), 2);
        $this->assertEquals(Auth::user()->hasRole('worker'), false);
        $this->assertEquals(Auth::user()->hasRole('manager'), true);
        $this->assertEquals(Auth::user()->hasRole('workadmin'), true);
        Auth::logout();
        $response = $this->call('POST', '/login', [
            'email' => 'workadmin@dolgozo.com',
            'password' => 'aaaaaa',
            '_token' => csrf_token(),
        ]);
        $this->assertEquals(Auth::id(), 3);
        $this->assertEquals(Auth::user()->hasRole('worker'), false);
        $this->assertEquals(Auth::user()->hasRole('manager'), false);
        $this->assertEquals(Auth::user()->hasRole('workadmin'), true);
    }

}
