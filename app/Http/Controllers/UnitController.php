<?php

namespace App\Http\Controllers;

use App\Services\UnitService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controlador de unidades de venda.
 */
final class UnitController extends Controller
{
    use Reading;

    /**
     * Inicializa propriedades.
     *
     * @param UnitService $service    O serviço de unidades.
     */
    public function __construct(UnitService $service)
    {
        parent::__construct();

        $this->service = $service;
    }

    /**
     * Resgata os registros.
     *
     * @param Request $request  Os dados da requisição.
     *
     * @return JsonResponse A resposta da requisição.
     */
    public function retrieveAll(Request $request): JsonResponse
    {
        $this->data = $this->service->getAll(
            $this->user,
            ['division' => $request->id]
        );

        return $this->send();
    }
}
