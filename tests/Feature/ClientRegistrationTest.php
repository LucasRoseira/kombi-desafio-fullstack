<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendClientRegisteredEmail;

class ClientRegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_registration_dispatches_job_and_sends_email()
    {
        Queue::fake();
        Mail::fake();

        $payload = [
            'name' => 'Teste Cliente',
            'email' => 'teste@example.com',
            'phone' => '11999999999',
            'cnpj' => '11222333000181',
            'cep' => '01001000',
            'state' => 'SP',
            'city' => 'São Paulo',
            'street' => 'Rua Teste',
            'number' => '123',
            'complement' => 'Apto 45',
            'agreed' => true,
        ];

        $response = $this->postJson('/api/clients', $payload);

        $response->assertStatus(201);

        $this->assertDatabaseHas('clients', [
            'email' => 'teste@example.com',
            'state' => 'SP',
        ]);

        Queue::assertPushed(SendClientRegisteredEmail::class);
    }
}
