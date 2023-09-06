<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\SaleRepository;

/**
 * Serviço de vendas.
 */
final class SaleService extends Service
{
    /**
     * @var SaleRepository Repositório de vendas.
     */
    private SaleRepository $sale;

    /**
     * @var GeolocationService Serviço de geolocalização.
     */
    private GeolocationService $geolocationService;

    /**
     * Inicializa propriedades.
     *
     * @param SaleRepository $sale                      O repositório de vendas.
     * @param GeolocationService $geolocationService    O serviço de
     * geolocalização.
     */
    public function __construct(
        SaleRepository $saleRepository,
        GeolocationService $geolocationService
    ) {
        $this->saleRepository = $saleRepository;
        $this->geolocationService = $geolocationService;
    }

    /**
     * Resgata uma venda pelo seu ID.
     * 
     * @param User $user    O usuário autenticado.
     * @param int $id       O ID da venda.
     * 
     * @return array Os dados da resposta.
     */
    public function getByID(User $user, int $id): array
    {
        $sale = $this->saleRepository->fetchByID($user, $id);

        return ($sale)
            ? $this->prepareForSuccess($sale)
            : $this->prepareForFailure('Sale not found.', 404);
    }

    /**
     * Resgata a relação de vendas.
     * 
     * @param User $user    O usuário autenticado.
     * @param array $filter Os filtros fornecidos.
     *
     * @return array Os dados da resposta.
     */
    public function getAll(User $user, array $filter = [])
    {
        $sales = $this->saleRepository->fetch($user, $filter);

        return $this->prepareForSuccess($sales, true);
    }

    /**
     * Insere uma nova venda no banco de dados.
     *
     * @param array $data   Os dados da venda.
     * @param User $user    O usuário autenticado.
     *
     * @return array O objeto da venda criada.
     */
    public function insert(array $data, User $user): array
    {
        // Resgata a unidade mais próxima da localização onde a venda ocorreu.
        $nearestUnit = $this->geolocationService->getNearestUnit([
            $data['latitude'],
            $data['longitude']
        ]);

        $sellerUnit = $user->unit;
        // Verifica se a unidade mais próxima é a unidade a qual o vendedor
        // pertence. Se não for, adicona a unidade mais próxima ao registro da
        // venda como roaming.
        if ($nearestUnit && $nearestUnit->id !== $sellerUnit->id) {
            $data['roaming_unit_id'] = $nearestUnit->id;
        }

        // Registra a unidade da venda.
        $data['unit_id'] = $sellerUnit->id;
        // Registra o usuário vendedor.
        $data['seller_id'] = $user->id;

        return $this->prepareForSuccess($this->saleRepository->create($data));
    }
}
