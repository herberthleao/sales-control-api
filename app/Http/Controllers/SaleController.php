<?php

namespace App\Http\Controllers;

use App\Exceptions\ClientException;
use App\Http\Requests\SaleCreationRequest;
use App\Http\Requests\SaleFilterRequest;
use App\Repositories\SaleRepository;
use App\Services\SaleService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Controlador de vendas.
 */
final class SaleController extends Controller
{
    use Reading;

    /**
     * Inicializa propriedades.
     *
     * @param SaleRepository $repository    O repositório de vendas.
     * @param SaleService $service          O serviço de vendas.
     */
    public function __construct(
        SaleRepository $repository,
        SaleService $service
    ) {
        parent::__construct();

        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * Resgata todas as vendas oferecendo filtros.
     *
     * @param SaleFilterRequest $request    Os filtros da requisição.
     *
     * @return JsonResponse A resposta da requisição.
     */
    public function retrieveAll(SaleFilterRequest $request): JsonResponse
    {
        // Pega os filtros.
        $data = $request->validated();

        // Faz o resgate dos registros filtrados.
        $this->data = $this->service->getAll($this->user, $data);

        return $this->send();
    }

    /**
     * Resgata uma venda específica.
     *
     * @param Request $request  Os dados da requisição.
     *
     * @return JsonResponse A venda solicitada. Caso contrário, um erro 404.
     */
    public function retrieve(Request $request): JsonResponse
    {
        try {
            $this->data = $this->service->getByID($this->user, $request->id);
        } catch (ClientException $exception) {
            $this->data['message'] = $exception->getMessage();
            $this->status = $exception->getCode();
        }

        return $this->send();
    }

    /**
     * Registra uma nova venda.
     *
     * @param SaleCreationRequest $request  Os dados da venda.
     *
     * @return JsonResponse O objeto da venda registrada.
     */
    public function register(SaleCreationRequest $request): JsonResponse
    {
        // Valida e resgata os dados da venda.
        $data = $request->validated();

        $this->data['data'] = $this->service->insert($data, $this->user);
        $this->status = 201;

        return $this->send();
    }
}
