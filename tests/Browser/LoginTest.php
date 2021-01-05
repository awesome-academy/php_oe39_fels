<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testAccessPage()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                    ->assertSee('Laravel');
        });
    }

    public function testLoginFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                    ->type('username', 'Thientran98qb@gmail.comm')
                    ->type('password', '123')
                    ->press('#btn_login')
                    ->assertPathIs('/login');
        });
    }
    public function test_I_can_login_successfully()
    {
        $this->browse(function ($browser) {
            $browser->visit('/login')
                    ->type('email', 'thientran98qb@gmail.com')
                    ->type('password', 'Thien123')
                    ->press('#btn-login')
                    ->assertPathIs('/home');
        });
    }
}
