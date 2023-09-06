<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Models\Unit;
use App\Models\User;

use Illuminate\Support\Collection;

/**
 * Repositório de unidades.
 */
final class UnitRepository extends Repository
{
    /**
     * Inicializa propriedades.
     *
     * @param Unit $unit    Modelo de unidade.
     */
    public function __construct(Unit $model)
    {
        parent::__construct($model);
    }

    /**
     * Resgata as unidades do banco de dados.
     *
     * O resgate das unidades ocorre de acordo com a função (role) do usuário.
     *
     * @param User $user    O usuário autenticado.
     * @param array $filter Possíveis filtros.
     *
     * @return Collection As unidades encontradas.
     */
    public function fetch(User $user, array $filter = []): Collection
    {
        $model = $this->model::where('division_id', $filter['division']);

        return match ($user->role) {
            // Todas as unidades.
            Role::GENERAL_DIRECTOR->name => $model->get(),
            // Apenas as uniades pertencentes à esta diretoria.
            Role::DIRECTOR->name => $model->whereHas(
                'division',
                function ($query) use ($user) {
                    $query->where('id', $user->division->id);
                }
            )->get(),
            // Apenas a unidade deste usuário.
            Role::MANAGER->name => $model->where(
                'manager_id',
                $user->id
            )->get(),
            default => []
        };
    }
}
