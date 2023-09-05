<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * Testa a emissão de token de acesso, sem corpo na requisição.
     */
    public function test_token_issuance_without_body(): void
    {
        $response = $this->json('POST', '/api/auth/tokens');

        $response->assertStatus(422);
    }

    /**
     * Testa a emissão de token de acesso, com credenciais inválidas.
     */
    public function test_token_issuance_with_invalid_credentials(): void
    {
        $response = $this->json('POST', '/api/auth/tokens', [
            'email' => 'john@doe.test',
            'password' => '123456789'
        ]);

        $response->assertStatus(401);
    }

    /**
     * Testa a emissão de token de acesso, com dados válidos.
     */
    public function test_token_issuance(): void
    {
        $response = $this->json('POST', '/api/auth/tokens', [
            'email' => 'pele@magazineaziul.com.br',
            'password' => '123mudar'
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [
                'access_token',
                'token_type'
            ]
        ]);
    }
}
