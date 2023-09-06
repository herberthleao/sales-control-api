<?php

namespace App\Services;

use App\Enums\Role;
use App\Exceptions\ClientException;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

/**
 * Serviço de autenticação.
 */
final class AuthService extends Service
{
    /**
     * @var User Modelo de usuários.
     */
    private User $user;

    /**
     * Inicializa propriedades.
     *
     * @param User $user    O modelo de usuários.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Realiza a autenticaçõa do usuário emitindo um novo token de acesso.
     *
     * @param string[] $credentials As credenciais do usuário.
     * 
     * @throws ClientException se as credenciais forem inválidas.
     *
     * @return string[] O token de acesso e seu tipo.
     */
    public function authenticate(array $credentials): array
    {
        // Verifica se as credenciais são inválidas.
        if (!Auth::attempt($credentials)) {
            return $this->prepareForFailure('Invalid credentials.',  401);
        }

        // Resgata os dados do usuário.
        $user = $this->user::where('email', $credentials['email'])->first();

        // Define as abilities (permissões) do usuário.
        $abilities = match ($user->role) {
            Role::GENERAL_DIRECTOR->name,
            Role::DIRECTOR->name,
            Role::MANAGER->name => [
                'read-divisions',
                'read-units',
                'read-sellers'
            ],
            Role::SELLER->name => ['create-sales'],
            default => []
        };
        // Todos têm permissão para ler as vendas.
        $abilities[] = 'read-sales';

        // Gera um novo token de acesso, com as devidas abilities.
        $token = $user->createToken('auth_token', $abilities)->plainTextToken;

        return $this->prepareForSuccess([
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);
    }
}
