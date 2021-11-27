<?php

use LaJoie\modules\Auth;
use PHPUnit\Framework\TestCase;

class AuthUnitTest extends TestCase
{
    /** @test */
    public function loginWithNoPasswordReturns401NotAuthenticated()
    {
        Auth::login("fark@gmail.com", "");
        $this->assertEquals(401, http_response_code());
    }

    /** @test */
    public function loginWithNoEmailReturns401NotAuthenticated()
    {
        Auth::login("", "maulana123");
        $this->assertEquals(401, http_response_code());
    }

    /** @test */
    public function loginWithNoDataReturns401NotAuthenticated()
    {
        Auth::login("", "maulana123");
        $this->assertEquals(401, http_response_code());
    }

    /** @test */
    public function loginWithValidEmailAndPasswordReturns200OK()
    {
        Auth::login("fark@gmail.com", "maulana123");
        $this->assertJson(200, http_response_code());
    }
}
