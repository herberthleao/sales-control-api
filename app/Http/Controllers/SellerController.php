<?php

namespace App\Http\Controllers;

use App\Services\SellerService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controlador de vendedores.
 */
final class SellerController extends Controller
{
    use Reading;

    /**
     * Inicializa propriedades.
     *
     * @param SellerService $service  O serviço de vendedores.
     */
    public function __construct(SellerService $service)
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
            ['division' => $request->divisionID, 'unit' => $request->unitID]
        );

        return $this->send();
    }
}
