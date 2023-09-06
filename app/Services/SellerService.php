<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\SellerRepository;

/**
 * Serviço de vendedor.
 */
final class SellerService extends Service
{
    /**
     * @var SellerRepository Repositório de vendedor.
     */
    private SellerRepository $seller;

    /**
     * Inicializa propriedades.
     *
     * @param SellerRepository $seller  O repositório de vendedor.
     */
    public function __construct(SellerRepository $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * Resgata a relação de vendedor.
     * 
     * @param User $user    O usuário autenticado.
     * @param array $filter Os filtros fornecidos.
     *
     * @return array Os dados da resposta.
     */
    public function getAll(User $user, array $filter = []): array
    {
        $sellers = $this->sellerRepository->fetch($user, $filter);

        return $this->prepareForSuccess($sellers, true);
    }
}