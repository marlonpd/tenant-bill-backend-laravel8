<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use WithFaker;
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

    public function test_required_fields_in_registering_user()
    {
        $this->json('POST', 'api/register', ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "name" => ["The name field is required."],
            ]
        ]);
    }


    public function test_success_registration()
    {
        $faker = \Faker\Factory::create();
        
        $userData = [
            "name" => "John Doe",
            "email" => preg_replace('/@example\..*/', '@domain.com', $faker->unique()->safeEmail),
            "password" => "demo12345",
            "password2" => "demo12345",
        ];

        $this->json('POST', 'api/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully created an account'
            ]);
    }

    public function test_required_fields_login_user()
    {
        $this->json('POST', 'api/authenticate', ['Accept' => 'application/json'])
        ->assertStatus(422)
        ->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "email"=> [
                    "The email field is required."
                ],
                "password"=> [
                    "The password field is required."
                ]
            ]
        ]);
    }


    public function test_successful_login()
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

        $this->json('POST', 'api/authenticate', $userData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure([
                "success",
                "user",
                "token"
            ]);;
    }
}