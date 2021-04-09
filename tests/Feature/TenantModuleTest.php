<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function get_login_token()
    {
        $faker = \Faker\Factory::create();

        $email = preg_replace('/@example\..*/', '@domain.com', $faker->unique()->safeEmail);
        $password = "password";

        $userData = [
            "name" => "John Doe",
            "email" => $email,
            "password" => $password,
            "password2" => $password,
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully created an account'
            ]);

        $userData = [
            "email" => $email,
            "password" =>  $password,
        ];

        $response = $this->json('POST', 'api/authenticate', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "success",
                "user",
                "token"
            ]);
        
        $token = $response->json()['token'];
        
        return $token;
    }

    public function test_getting_limited_tenants()
    {
        $token = $this->get_login_token();
        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', '/api/tenants');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
               'tenants',
            ]
        );
    }
}