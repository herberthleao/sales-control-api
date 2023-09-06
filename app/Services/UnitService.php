<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UnitRepository;

/**
 * Serviço de unidades de vendas.
 */
final class UnitService extends Service
{
    /**
     * @var UnitRepository Repositório de unidades de vendas.
     */
    private UnitRepository $unit;

    /**
     * Inicializa propriedades.
     *
     * @param unitRepository $unit  O repositório de unidades de vendas.
     */
    public function __construct(unitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    /**
     * Resgata a relação de unidades de vendas.
     * 
     * @param User $user    O usuário autenticado.
     * @param array $filter Os filtros fornecidos.
     *
     * @return array Os dados da resposta.
     */
    public function getAll(User $user, array $filter = []): array
    {
        $units = $this->unitRepository->fetch($user, $filter);

        return $this->prepareForSuccess($units, true);
    }
}
