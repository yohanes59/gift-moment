<?php

namespace Tests\Feature\Controllers\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/category');

        $response->assertStatus(200);
    }

    public function testCreate()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/admin/category/create');

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.form');
    }

    public function testStore()
    {
        $this->withoutExceptionHandling();

        Storage::fake('public');

        $name = $this->faker->word;

        $response = $this->post('/admin/category', [
            'name' => $name,
            'image' => UploadedFile::fake()->image('category.jpg')
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/category');
        $this->assertDatabaseHas('categories', [
            'name' => $name,
            'slug' => fake()->name(),
            'image' => 'category.jpg'
        ]);

        Storage::disk('public')->Exists('assets/category/category.jpg');
    }

    public function testEdit()
    {
        $this->withoutExceptionHandling();

        $category = Category::factory()->create();

        $response = $this->get('/admin/category/' . $category->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.form');
        $response->assertViewHas('item', $category);
    }

    public function testDestroy()
    {
        $category = Category::factory()->create();

        $response = $this->delete('/admin/category/' . $category->id);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/category');

        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}