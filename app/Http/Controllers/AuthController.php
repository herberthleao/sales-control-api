<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Requests\AuthCreationRequest;
use App\Services\AuthService;

use Illuminate\Http\JsonResponse;

/**
 * Controlador de autenticação.
 */
final class AuthController extends Controller
{
    /**
     * @var AuthService Serviço de autenticação.
     */
    private AuthService $service;

    /**
     * Inicializa propriedades.
     *
     * @param AuthService $service  Serviço de autenticação.
     */
    public function __construct(AuthService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Realiza o login do usuário emitindo um novo token de acesso.
     *
     * @param AuthCreationRequest $request  Os dados da requisição.
     *
     * @return JsonResponse O token de acesso em caso de sucesso. Caso contário,
     * um erro 401.
     */
    public function login(AuthCreationRequest $request): JsonResponse
    {
        try {
            $this->data = $this->service->authenticate($request->validated());
        } catch (ClientException $exception) {
            $this->data['message'] = $exception->getMessage();
            $this->status = $exception->getCode();
        }

        return $this->send();
    }
}
