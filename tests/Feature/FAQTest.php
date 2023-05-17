<?php

namespace Tests\Unit\Controllers\Admin;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Faq;

class FaqControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexReturnsView()
    {
        $response = $this->get('/admin/faq');
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.faq.index');
    }

    public function testCreateReturnsView()
    {
        $response = $this->get('/admin/faq/create');
        
        $response->assertStatus(200);
        $response->assertViewIs('admin.faq.form');
    }

    public function testStoreCreatesNewFaq()
    {
        $data = [
            // Provide the necessary data for the Faq creation
            'question' => 'Example Question',
            'answer' => 'Example Answer',
        ];
        
        $response = $this->post('/admin/faq', $data);
        
        $response->assertStatus(302);
        $response->assertRedirect('/admin/faq');
        
        $this->assertDatabaseHas('faqs', $data);
    }

    /** @test */
    public function edit_method_returns_view_with_faq_data()
    {
        $faq = Faq::factory()->create();

        $response = $this->get('admin.faq.edit', $faq->id);
        $response->assertStatus(200);
        $response->assertViewIs('admin.faq.form');
        $response->assertViewHas('item', $faq);
    }

}
