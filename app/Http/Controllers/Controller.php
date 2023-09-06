<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

/**
 * Controlador base.
 */
abstract class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @var array Os dados da resposta da requisição.
     */
    protected array $data = [];

    /**
     * @var int O código do status da resposta da requisição.
     */
    protected int $status = 200;

    /**
     * @var User|null O usuário autenticado.
     */
    protected readonly ?User $user;

    /**
     * Inicializa propriedades.
     */
    public function __construct()
    {
        // Define o usuário autenticado, se houver.
        $this->user = (auth('sanctum')->user())
            ? auth('sanctum')->user()
            : null;
    }

    /**
     * Envia os dados da resposta da requisição.
     *
     * @return JsonResponse A resposta da requisição.
     */
    protected function send(): JsonResponse
    {
        return response()->json($this->data, $this->status);
    }
}
