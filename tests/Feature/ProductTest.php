<?php

namespace Tests\Feature\Admin;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class ProductControllerTest extends TestCase
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

    public function testViewAdminProduct()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/product');

        $this->withoutExceptionHandling();

        $response = $this->get('/product');

        $response->assertStatus(200);

        $response->assertSee('List Produk');
        $response->assertSee('Tambah Produk');
        $response->assertSee('ID');
        $response->assertSee('Gambar');
        $response->assertSee('Nama');
        $response->assertSee('Gambar');
        $response->assertSee('Kategori');
        $response->assertSee('Sisa Stok');
        $response->assertSee('Harga Modal');
        $response->assertSee('Harga Jual');
        $response->assertSee('Aksi');
    }

    public function test_it_can_display_create_product_form()
    {
        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
        ->get('/admin/product/create');

        $response = $this->get('/admin/product/create');

        $response->assertStatus(200);
        $response->assertSee('Form Tambah Produk');
        $response->assertSee('Kategori');
    }

    public function test_it_can_display_edit_product_form()
    {
        $product = Product::factory()->create([
            'name' => fake()->name,
            'image' => fake()->imageUrl(),
            'price' => fake()->numberBetween(100, 1000),
            'capital_price' => fake()->numberBetween(50, 500),
            'description' => fake()->paragraph,
            'weight' => fake()->numberBetween(1, 10),
            'stock_amount' => fake()->numberBetween(0, 100),
            'minimum_order' => fake()->numberBetween(1, 5),
            'slug' => fake()->slug,
            'deleted_at' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]); // Buat produk dummy

        $response = $this->withSession(['_token' => csrf_token()]) // Tambahkan session data
                     ->get('/admin/product/'.$product->id.'/edit');

        $response->assertStatus(200);
        $response->assertSee('Form Edit Produk');
        $response->assertSee('Kategori');
    }

    public function test_admin_can_store_new_product()
    {
        $this->withoutMiddleware();

        $admin = User::factory()->create();
        $response = $this->actingAs($admin)->post('/admin/product', [
            'categories_id ' => 'sovenir',
            'name' => 'Gunting Kuku',
            'price' => 15000,
            'capital_price' => 15000,
            'description' => 'untuk gunting kuku',
            'weight' => 10,
            'minimum_order' => 50,
        ]);
        $response->assertRedirect('/admin/product');
        $this->assertCount(1, Product::all());
        $this->assertDatabaseHas('products', ['categories_id ' => 'sovenir','name' => 'Gunting Kuku','price' => 15000,'capital_price' => 15000,'description' => 'untuk gunting kuku','weight' => 10,'minimum_order' => 50]);
    }
}
