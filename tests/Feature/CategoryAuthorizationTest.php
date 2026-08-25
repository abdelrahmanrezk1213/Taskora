<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryAuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_view_categories_page(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)
            ->get('/categories');

        $response->assertOk();
    }

    public function test_user_cannot_create_category(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)
            ->get('/categories/create');

        $response->assertForbidden();
    }

    public function test_admin_can_create_category(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->get('/categories/create');

        $response->assertOk();
    }

    public function test_admin_can_store_category(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->post('/categories', [
                'name' => 'Test Category',
            ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);
    }

    public function test_user_cannot_edit_category(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->get('/categories/'.$category->id.'/edit');

        $response->assertForbidden();
    }

    public function test_admin_can_edit_category(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $category = Category::factory()->create();

        $response = $this->actingAs($admin)
            ->get('/categories/'.$category->id.'/edit');

        $response->assertOk();
    }

    public function test_admin_can_update_category(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $category = Category::factory()->create([
            'name' => 'Old Name',
        ]);

        $response = $this->actingAs($admin)
            ->put('/categories/'.$category->id, [
                'name' => 'Updated Name',
            ]);

        $response->assertRedirect('/categories');
        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
        ]);
    }

    public function test_user_cannot_delete_category(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->delete('/categories/'.$category->id);

        $response->assertForbidden();
    }

    public function test_admin_can_delete_category(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $category = Category::factory()->create();

        $response = $this->actingAs($admin)
            ->delete('/categories/'.$category->id);

        $response->assertRedirect('/categories');
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
