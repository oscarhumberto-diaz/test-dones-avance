<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_routes_redirect_to_login_when_guest(): void
    {
        $this->get('/admin')->assertRedirect('/admin/login');
        $this->get('/admin/consultas/historial')->assertRedirect('/admin/login');
    }

    public function test_admin_can_login_and_logout(): void
    {
        $user = User::query()->create([
            'username' => 'oscard',
            'password' => Hash::make('Oscar121*'),
        ]);

        $this->post('/admin/login', [
            'username' => 'oscard',
            'password' => 'Oscar121*',
        ])->assertRedirect('/admin');

        $this->assertAuthenticatedAs($user);

        $this->post('/admin/logout')->assertRedirect('/admin/login');
        $this->assertGuest();
    }
}
