<?php
use PHPUnit\Framework\TestCase;

class CsrfTest extends TestCase
{
    public function testUpdateStatusRequiresCsrfToken()
    {
        $content = file_get_contents(__DIR__ . '/../pages/update_status.php');
        $this->assertStringContainsString('Invalid CSRF token', $content);
    }

    public function testUpdateSolusiRequiresCsrfToken()
    {
        $content = file_get_contents(__DIR__ . '/../pages/update_solusi.php');
        $this->assertStringContainsString('Invalid CSRF token', $content);
    }
}
