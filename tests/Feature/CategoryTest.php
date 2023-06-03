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

    public function test_Admin_Category_View()
    {
        //Testing view List Data Category 
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category');

        $this->withoutExceptionHandling();

        $response = $this->get('/admin/category');

        $response->assertStatus(200);

        $response->assertSee('List Kategori');
        $response->assertSee('Tambah Kategori');
        $response->assertSee('ID');
        $response->assertSee('Gambar');
        $response->assertSee('Nama');
        $response->assertSee('Aksi');
    }

    public function test_form_Create_Category()
    {
        // Testing view Category
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category/create');

        $this->withoutExceptionHandling();

        $response = $this->get('/admin/category/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.form');
    }

    public function test_Store_Category()
    {
        // Testing Add Category
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category');

        $this->withoutExceptionHandling();

        Storage::fake('public');
        
        $image = UploadedFile::fake()->image('category.jpg');

        $response = $this->post('/admin/category', [
            'name' => 'Test Category',
            'image' => $image,
        ]);

        $response->assertRedirect('/admin/category');

        $this->assertDatabaseHas('categories', [
            'name' => 'Test Category',
        ]);

        Storage::disk('public');
    }

    public function test_Form_Edit_Category()
    {
        // Testing Find id Category
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category/edit');
        
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->get('/admin/category/' . $category->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.form');
        $response->assertViewHas('item', $category);
    }

    public function test_update_category()
    {
        // Testing Update Category
        $category = Category::factory()->create([
            'name' => 'Talenan',
        ]);

        $data = [
            'name' => 'sovenir',
        ];

        $response = $this->put("/admin/category/{$category->id}", $data);
        $response->assertRedirect('/admin/category');

        $this->assertDatabaseHas('categories', $data);
    }

    public function test_Delete_Category()
    {
        // Testing Delete Category
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/category/');

        $category = Category::factory()->create([
            'name' => 'Talenan',
        ]);

        $response = $this->delete("/admin/category/{$category->id}");
        $response->assertRedirect('/admin/category');

        $this->delete($category);
    }
}