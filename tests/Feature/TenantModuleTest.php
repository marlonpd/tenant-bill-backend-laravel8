<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

  //print_r($response->getContent());  
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

    public function test_success_store_tenant()
    {
        $token = $this->get_login_token();  

        $tenantData = [
            "name" => "John Doe",
            "meterNumber" => "999999999",
            "meterInitialReading" => "00000000",
        ];

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', '/api/tenant/store', $tenantData, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
              'success',
              'tenant',
            ]
        );
    }


    public function test_success_search_tenant()
    {
        $token = $this->get_login_token();        

        $sampleTenantData = [
            'name' => 'Marlon test',
            'meterNumber' => '9999999',
            'meterInitialReading' => '1111111',
        ];

        $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', '/api/tenant/store', $sampleTenantData, ['Accept' => 'application/json']);

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', '/api/tenants/search/test');
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
              'tenants',
              'count',
            ]
        );
    }


    public function test_success_update_tenant()
    {
        $token = $this->get_login_token();  

        $tenantData = [
            "name" => "John Doe",
            "meterNumber" => "999999999",
            "meterInitialReading" => "00000000",
        ];

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', '/api/tenant/store', $tenantData, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
              'success',
              'tenant',
            ]
        );

        $tenant = $response->json()['tenant'];

        $tenantData = [
            "id" => $tenant['id'],
            "name" => "John Doe",
            "meterNumber" => "999999999",
            "meterInitialReading" => "00000000",
        ];

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('PUT', '/api/tenant/update', $tenantData, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
              'success',
              'tenant',
            ]
        );
    }

    public function test_success_delete_tenant()
    {
        $token = $this->get_login_token();  

        $tenantData = [
            "name" => "John Doe",
            "meterNumber" => "999999999",
            "meterInitialReading" => "00000000",
        ];

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', '/api/tenant/store', $tenantData, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
              'success',
              'tenant',
            ]
        );

        $tenant = $response->json()['tenant'];

        $tenantData = [
            "id"    => $tenant['id'],
        ];

        $response =  $this->withHeader('Authorization', 'Bearer ' . $token)->json('DELETE', '/api/tenant/delete', $tenantData, ['Accept' => 'application/json']);
        $response->assertStatus(200);
        $response->assertJsonStructure(
            [
              'success',
            ]
        );
    }
}