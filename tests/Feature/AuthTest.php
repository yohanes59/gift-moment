<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testRegisterPage()
    {
        $this->get('register')->assertSeeText('Register');
    }

    public function testLogin_success_For_Admin()
    {
        // Unit Test Jika Admin Sudah Login Maka Redirect ke Halaman dashboard
            User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123'),
            'roles' => 'Admin'
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@gmail.com',
            'password' => '123'
        ]);
        $response->assertStatus(302);
        $response->assertRedirect('/admin/dashboard');
    }

    public function test_Login_success_For_User()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }

    public function registerForUser()
    {
        $response = $this->post('/register', [
            'email' => 'user@gmail.com',
            'password' => '123'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_if_admin_not_login_cannot_access_admin_dasboard()
    {
        // Unit Test Jika Admin belum login maka tidak boleh aksess halaman dashboard
        $response = $this->get('/admin/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

   public function testValidationError()
   {
        $response = $this->post('/login', []);
        $response->assertStatus(302);
        $response->assertRedirect('/');
   }

   public function testLoginForAdminAlreadyLogin()
   {
        $this->withSession([
            "name" => "admin"
        ])->post('/login', [
            "email" => "admin@gmail.com",
            "password" => "123"
        ])->assertRedirect("/admin/dashboard")->assertSessionHas("name","admin");
    }
}
