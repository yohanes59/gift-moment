<?php

namespace Tests\Feature;

use App\Models\Faq;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class FAQTest extends TestCase
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



    /**
     * Test index method.
     *
     * @return void
     */
    public function testIndex()
    {
        $response = $this->get('/admin/faq');

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq.index');
        $response->assertSeeText('Menu FAQ');
        $response->assertSeeText('Tambah');
        $response->assertSeeText('Pertanyaan');
        $response->assertSeeText('Jawaban');
        $response->assertSeeText('Aksi');
    }

    /**
     * Test create method.
     *
     * @return void
     */
    public function testCreate()
    {
        $response = $this->get('/admin/faq/create');

        $response->assertStatus(200);
    }

    /**
     * Test store method.
     *
     * @return void
     */
    public function testStore()
    {
        $data = [
            'question' => 'Test Question',
            'answer' => 'Test Answer',
        ];

        $response = $this->post('/admin/faq', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/faq');
        $this->assertDatabaseHas('faqs', $data);
    }

    /**
     * Test edit method.
     *
     * @return void
     */
    public function testEdit()
    {
        $faq = Faq::factory()->create();

        $response = $this->get('/admin/faq/' . $faq->id . '/edit');

        $response->assertStatus(200);
        $response->assertViewIs('admin.faq.form');
        $response->assertViewHas('item', $faq);
    }

    /**
     * Test update method.
     *
     * @return void
     */
    public function testUpdate()
    {
        $faq = Faq::factory()->create();

        $data = [
            'question' => 'Updated Question',
            'answer' => 'Updated Answer',
        ];

        $response = $this->put('/admin/faq/' . $faq->id, $data);

        $response->assertStatus(302);
        $response->assertRedirect('/admin/faq');
        $this->assertDatabaseHas('faqs', $data);
    }

    /**
     * Test destroy method.
     *
     * @return void
     */
    public function testDestroy()
    {
        $faq = Faq::factory()->create([
            'question' => 'Test Question',
            'answer' => 'Test Answer'
        ]);

        $response = $this->delete("/admin/faq/{$faq->id}");
        $response->assertRedirect('/admin/faq');

        $this->delete($faq);
    }
}
