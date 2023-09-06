<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Models\User;

use Illuminate\Support\Collection;

/**
 * Repositório de vendedor.
 */
final class SellerRepository extends Repository
{
    /**
     * Inicializa propriedades.
     *
     * @param User $user    Modelo de vendedor.
     */
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    /**
     * Resgata os vendedores do banco de dados.
     *
     * O resgate dos vendedores ocorre de acordo com a função (role) do usuário.
     *
     * @param User $user    O usuário autenticado.
     * @param array $filter Possíveis filtros.
     *
     * @return Collection Os vendedores encontrados.
     */
    public function fetch(User $user, array $filter = []): Collection
    {
        $model = $this->model::where('unit_id', $filter['unit']);
        $model->whereHas('unit', function ($query) use ($filter) {
            $query->whereHas('division', function ($query) use ($filter) {
                $query->where('id', $filter['division']);
            });
        });

        return match ($user->role) {
            // Todos os vendedores.
            Role::GENERAL_DIRECTOR->name => $model->get(),
            // Apenas os vendedores pertencentes às unidades desta diretoria.
            Role::DIRECTOR->name => $model->whereHas(
                'unit',
                function ($query) use ($user) {
                    $query->whereHas('division', function ($query) use ($user) {
                        $query->where('id', $user->division->id);
                    });
                }
            )->get(),
            // Apenas os vendedores pertencentes à esta unidade.
            Role::MANAGER->name => $model->where(
                'unit_id',
                $user->managedUnit->id
            )->get(),
            default => []
        };
    }
}
