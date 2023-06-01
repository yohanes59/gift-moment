<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'roles' => 'Admin'
        ]);
        
        Auth::login($user); // Autentikasi pengguna
        Session::start(); // Mulai session
    }

    public function testIndex()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category');

        $this->withoutExceptionHandling();

        $response = $this->get('/admin/category');

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category/create');

        $this->withoutExceptionHandling();

        $response = $this->get('/admin/category/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.form');
    }

    public function testStore()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category');

        $this->withoutExceptionHandling();

        Storage::fake('public');

        $name = 'Sovenir';

        $response = $this->post('/admin/category', [
            'name' => $name,
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/category');
        $this->assertDatabaseHas('categories', [
            'name' => $name,
            'slug' => fake()->name(),
        ]);

        Storage::disk('public')->Exists('assets/category/category.jpg');
    }

    public function testEdit()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category/edit');
        
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->get('/admin/category/' . $category->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.form');
        $response->assertViewHas('item', $category);
    }

    public function testDestroy()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category/');

        $category = Category::factory()->create();

        $response = $this->delete('/admin/category/' . $category->id);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/category');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}