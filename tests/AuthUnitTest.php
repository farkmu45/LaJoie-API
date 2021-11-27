<?php

use LaJoie\modules\Auth;
use PHPUnit\Framework\TestCase;

class AuthUnitTest extends TestCase
{
    // Use composer test to use this unit test 

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
        Auth::login("", "");
        $this->assertEquals(401, http_response_code());
    }

    /** @test */
    public function loginWithInvalidDataReturns401NotAuthenticated()
    {
        Auth::login("dsafas", "fdafdsf");
        $this->assertEquals(401, http_response_code());
    }

    /** @test */
    public function loginWithValidEmailAndPasswordReturns200OK()
    {
        Auth::login("fark@gmail.com", "maulana123");
        $this->assertEquals(200, http_response_code());
    }
}
