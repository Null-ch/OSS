<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Contracts\Console\Kernel;

class RouteTest extends TestCase
{
    use RefreshDatabase;
    use WithoutMiddleware;
    
    public function createApplication()
    {
        $app = require __DIR__.'/../../bootstrap/app.php';
        $app->make(Kernel::class)->bootstrap();
        return $app;
    }

    /**
     * Отвлеченный пример функционального теста.
     *
     * @return void
     */
    public function testRouting()
    {
        $response = $this->get('/');
        $response->assertStatus(200);

        $response = $this->get('/shop');
        $response->assertStatus(200);

        $response = $this->get('/cart');
        $response->assertStatus(200);

        $response = $this->get('/item/1');
        $response->assertStatus(200);
    }
}