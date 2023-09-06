<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\DivisionRepository;

/**
 * Serviço de diretorias.
 */
final class DivisionService extends Service
{
    /**
     * @var DivisionRepository Repositório de diretorias.
     */
    private DivisionRepository $division;

    /**
     * Inicializa propriedades.
     *
     * @param DivisionRepository $division  O repositório de diretorias.
     */
    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    /**
     * Resgata a relação de diretorias.
     * 
     * @param User $user    O usuário autenticado.
     * @param array $filter Os filtros fornecidos.
     *
     * @return array Os dados da resposta.
     */
    public function getAll(User $user, array $filter = []): array
    {
        $divisions = $this->divisionRepository->fetch($user, $filter);

        return $this->prepareForSuccess($divisions, true);
    }
}
