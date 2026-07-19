<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_homepage_renders_with_named_order_route(): void
    {
        $response = $this->get(route('home'));

        $response
            ->assertOk()
            ->assertSee('Big flavor.')
            ->assertSee(route('order'), escape: false);
    }

    public function test_order_page_renders_with_named_home_route(): void
    {
        $response = $this->get(route('order'));

        $response
            ->assertOk()
            ->assertSee('Build Your Order')
            ->assertSee(route('home'), escape: false);
    }

    public function test_frontend_assets_are_in_public_directories(): void
    {
        $this->assertFileExists(public_path('css/home.css'));
        $this->assertFileExists(public_path('css/order.css'));
        $this->assertFileExists(public_path('js/home.js'));
        $this->assertFileExists(public_path('js/order.js'));
        $this->assertFileExists(public_path('assets/logo-round.png'));
    }
}
