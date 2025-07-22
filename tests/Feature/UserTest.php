<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_that_a_user_can_register(): void
    {
        //arrange
        $data = [
            'username' => 'john',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];


        //act
        $response = $this->post('api/signup', $data);

        //assert
        $response->assertCreated();
        $this->assertDatabaseHas('users', [
            'username' => 'john',
            'email' => 'john@example.com'
        ]);
    }

    public function test_that_a_user_can_login()
    {
        //arrange

        User::create([
            'username'=>'john',
            'email' => 'john@example.com',
            'password' => Hash::make('password123'),
        ]);

        $data = [
            'email' => 'john@example.com',
            'password' => 'password123',
        ];

        //act
        $response = $this->post('api/signin', $data);

        //assert
        $response->assertOk();
        $this->assertAuthenticated();
    }
}
