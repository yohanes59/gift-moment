<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;
    
    public function testLoginPage()
    {
        $this->get('/login')->assertSeeText('Login');
    }

    public function testRegisterPage()
    {
        $this->get('register')->assertSeeText('Register');
    }

    public function test_Login_success_For_Admin()
    {
        // Unit Test Jika Admin Sudah Login Maka Redirect ke Halaman dashboard
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
            'roles' => 'Admin'
        ]);

        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_Login_success_For_User()
    {
        // Unit Test ketika user sukses login
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/');
        $response->assertStatus(200);
    }

    public function test_user_cannot_login_with_incorrect_password()
    {
        // Unit Test jika user salah memasukan password
        User::factory()->create([
            'email' => 'test@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        
        $response = $this->from('/login')->post('/login', [
            'email' => 'test@gmail.com',
            'password' => 'invalid-password',
        ]);
        
        $response->assertRedirect('/login');
        $this->assertTrue(session()->hasOldInput('email'));
        $this->assertFalse(session()->hasOldInput('password'));
        $this->assertGuest();
    }

    public function testregisterForUser()
    {
        // Unit Test Untuk Register 
        $response = $this->post('/register', [
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_if_admin_not_login_cannot_access_admin_dasboard()
    {
        // Unit Test Jika Admin belum login maka tidak boleh aksess halaman dashboard, middleware test
        $response = $this->get('/admin/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_user_has_name_attribute()
    {
        $user = User::factory()->create([
            'name' => 'ujang',
            'email' => 'test@test.com',
            'password' => bcrypt('password')
        ]);

        $this->assertEquals('ujang', $user->name);
    }
}
