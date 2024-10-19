<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\Faq;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomeTest extends TestCase
{
    use RefreshDatabase;
    
    public function testHomeUser()
    {
        $response = $this->get('/');
    
        $response->assertStatus(200)
            ->assertViewIs('customer.home.index')
            ->assertViewHasAll(['categories', 'products', 'faq']);
        }
    
    public function test_show_product_by_category()
    {
        // Membuat data dummy
        $category1 = Category::factory()->create(['name' => 'Sovenir']);
        $category2 = Category::factory()->create(['name' => 'Hantaran']);
        $product1 = Product::factory()->create([
            'categories_id' => $category1->id,
            'name' => 'Produk Kategori 1'
        ]);
        $product2 = Product::factory()->create([
            'categories_id' => $category2->id,
            'name' => 'Produk Kategori 2'
        ]);
    
        // Memanggil halaman dengan kategori tertentu
        $response = $this->get('/category/' . $category1->slug);
    
        // Memastikan halaman berhasil dimuat
        $response->assertStatus(200);
    
        // Memastikan hanya produk dari kategori yang dipilih ditampilkan
        $response->assertSee($product1->name);
        $response->assertDontSee($product2->name);
    }
    
        public function test_product_search()
    {
        // Membuat data dummy
        $category = Category::factory()->create();
        $product1 = Product::factory()->create([
            'categories_id' => $category->id,
            'name' => 'Produk Test 1'
        ]);
        $product2 = Product::factory()->create([
            'categories_id' => $category->id,
            'name' => 'Produk Test 2'
        ]);

        // Memanggil halaman dengan pencarian
        $response = $this->get('/search?search=Test');

        // Memastikan halaman berhasil dimuat
        $response->assertStatus(200);

        // Memastikan produk yang sesuai dengan pencarian ditampilkan
        $response->assertSee($product1->name);
        $response->assertSee($product2->name);
    }
}