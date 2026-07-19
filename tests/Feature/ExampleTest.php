<?php

namespace Tests\Feature;

use App\Models\HomepageFeature;
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
            ->assertSee('class="menu-toggle"', escape: false)
            ->assertSee('aria-controls="main-menu"', escape: false)
            ->assertSee('/js/home.js?v='.filemtime(public_path('js/home.js')), escape: false)
            ->assertSee(route('order'), escape: false);
    }

    public function test_homepage_uses_fallback_images_when_feature_records_are_missing(): void
    {
        HomepageFeature::query()->delete();

        $this->get(route('home'))
            ->assertOk()
            ->assertSee(asset('assets/Food/1.jpg'), escape: false)
            ->assertSee(asset('assets/Food/item-400000005201719302_1687995743.jpg'), escape: false)
            ->assertSee(asset('assets/Food/2.jpg'), escape: false);
    }

    public function test_order_page_renders_with_named_home_route(): void
    {
        $response = $this->get(route('order'));

        $response
            ->assertOk()
            ->assertSee('Build Your Order')
            ->assertSee('<script src="/js/order.js" defer></script>', escape: false)
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
