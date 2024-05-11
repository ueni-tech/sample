<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TemplateMethodTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        parent::setUpBeforeClass();
        echo '__setUpBeforeClas__', PHP_EOL;
    }

    protected function setUp(): void
    {
        parent::setUp();
        echo '__setUp__', PHP_EOL;
    }

    /**
     * @test
     */
    public function テストメソッド1()
    {
        echo '__METHOD__', PHP_EOL;
        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function テストメソッド2()
    {
        echo '__METHOD__', PHP_EOL;
        $this->assertTrue(true);
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        echo '__tearDown__', PHP_EOL;
    }

    public static function tearDownAfterClass(): void
    {
        parent::tearDownAfterClass();
        echo '__tearDownAfterClass__', PHP_EOL;
    }
    
}
