<?php

namespace Tests\Feature;

use App\Models\HomepageFeature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminGoodStuffTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();
    }

    public function test_guests_are_redirected_to_the_admin_login(): void
    {
        $this->get(route('admin.good-stuff.index'))
            ->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_log_in(): void
    {
        $this->post(route('admin.login.store'), [
            'email' => config('admin.email'),
            'password' => config('admin.password'),
        ])->assertRedirect(route('admin.good-stuff.index'));

        $this->assertAuthenticated();
    }

    public function test_admin_can_replace_a_good_stuff_picture(): void
    {
        Storage::fake('public');

        $feature = HomepageFeature::query()->firstOrFail();
        $user = User::query()->firstOrFail();

        $this->actingAs($user)
            ->put(route('admin.good-stuff.update', $feature), [
                'image' => UploadedFile::fake()->image('replacement.jpg', 800, 600),
            ])
            ->assertRedirect();

        $feature->refresh();

        $this->assertNotNull($feature->image_path);
        Storage::disk('public')->assertExists($feature->image_path);
    }

    public function test_admin_can_upload_a_picture_larger_than_the_old_two_megabyte_php_limit(): void
    {
        Storage::fake('public');

        $feature = HomepageFeature::query()->firstOrFail();
        $user = User::query()->firstOrFail();

        $this->actingAs($user)
            ->put(route('admin.good-stuff.update', $feature), [
                'image' => UploadedFile::fake()->image('large-replacement.jpg', 1600, 1200)->size(3072),
            ])
            ->assertSessionHasNoErrors()
            ->assertRedirect();

        Storage::disk('public')->assertExists($feature->refresh()->image_path);
    }

    public function test_admin_cannot_upload_a_picture_larger_than_five_megabytes(): void
    {
        Storage::fake('public');

        $feature = HomepageFeature::query()->firstOrFail();
        $user = User::query()->firstOrFail();

        $this->actingAs($user)
            ->from(route('admin.good-stuff.index'))
            ->put(route('admin.good-stuff.update', $feature), [
                'image' => UploadedFile::fake()->image('too-large.jpg')->size(5121),
            ])
            ->assertSessionHasErrors('image')
            ->assertRedirect(route('admin.good-stuff.index'));
    }
}
