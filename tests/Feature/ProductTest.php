<?php

namespace Tests\Feature\Admin;

use App\Http\Requests\ProductRequest;
use Tests\TestCase;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    private $product;

    public function setup(): void
    {
        parent::setup();

        $this->product = Product::factory()->create();
    }

    /**
     * Test the index method of ProductController.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/admin/product');

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.index');
    }

    /**
     * Test the create method of ProductController.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get('/admin/product/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.product.form');
    }
    
    public function test_admin_can_store_new_product()
    {
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

    public function test_admin_can_see_the_edit_product_page()
    {
        $admin = User::factory()->create();
        $product = Product::factory()->create();
        $response = $this->actingAs($admin)->get('/admin/product/'. $product->id. '/edit');
        $response->assertStatus(200);
        $response->assertSee($product->name);
    }
}