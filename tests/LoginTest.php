<?php
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    private string $loginFile;

    protected function setUp(): void
    {
        $this->loginFile = file_get_contents(__DIR__ . '/../pages/login.php');
    }

    public function testSuccessfulLogin()
    {
        // Check that session variables are set on successful login
        $this->assertStringContainsString('$_SESSION[\'user_id\']', $this->loginFile);
        $this->assertStringContainsString('$_SESSION[\'username\']', $this->loginFile);
        $this->assertStringContainsString('$_SESSION[\'csrf_token\']', $this->loginFile);
    }

    public function testFailedLoginWithWrongPassword()
    {
        // Ensure error message for wrong password exists
        $this->assertStringContainsString('Password salah', $this->loginFile);
    }
}
