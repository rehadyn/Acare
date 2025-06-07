<?php
use PHPUnit\Framework\TestCase;

class CsrfTest extends TestCase
{
    public function testTokenGeneration()
    {
        \session_start();
        unset($_SESSION['csrf_token']);
        $token = ensure_csrf_token();
        $this->assertNotEmpty($token);
        $this->assertEquals($token, $_SESSION['csrf_token']);
    }

    public function testTokenVerification()
    {
        \session_start();
        $token = ensure_csrf_token();
        $this->assertTrue(verify_csrf_token($token));
        $this->assertFalse(verify_csrf_token('invalid'));
    }
}
