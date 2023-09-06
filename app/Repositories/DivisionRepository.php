<?php

namespace App\Repositories;

use App\Models\Division;
use App\Models\User;
use App\Enums\Role;

use Illuminate\Support\Collection;

/**
 * Repositório de diretoria.
 */
final class DivisionRepository extends Repository
{
    /**
     * Inicializa propriedades.
     *
     * @param Division $model   Modelo de diretoria.
     */
    public function __construct(Division $model)
    {
        parent::__construct($model);
    }

    /**
     * Resgata as diretorias do banco de dados.
     *
     * O resgate das diretorias ocorre de acordo com a função (role) do usuário.
     *
     * @param User $user    O usuário autenticado.
     * @param array $filter Possíveis filtros.
     *
     * @return Collection As diretorias encontradas.
     */
    public function fetch(User $user, array $filter = []): Collection
    {
        return match ($user->role) {
            // Todas as diretorias.
            Role::GENERAL_DIRECTOR->name => $this->model::get(),
            // Apenas a diretoria dirigida pelo usuário.
            Role::DIRECTOR->name => $this->model::where(
                'id',
                $user->division->id
            )->get(),
            // Apenas a diretoria ao qual a unidade do usuário gerente pertence.
            Role::MANAGER->name => $this->model::where(
                'id',
                $user->managedUnit->division->id
            )->get(),
            default => []
        };
    }
}
