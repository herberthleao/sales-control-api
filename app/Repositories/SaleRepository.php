<?php

namespace App\Repositories;

use App\Enums\Role;
use App\Exceptions\ClientException;
use App\Models\Sale;
use App\Models\User;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * Repositório de vendas.
 */
final class SaleRepository extends Repository
{
    /**
     * Inicializa propriedades.
     *
     * @param Sale $model O modelo de vendas.
     */
    public function __construct(Sale $model)
    {
        parent::__construct($model);
    }

    /**
     * Resgata uma determinada venda pelo seu ID.
     *
     * @param User $user    O usuário autenticado.
     * @param int $id       O ID da venda.
     *
     * @throws ClientException se a venda não for encontrada.
     *
     * @return Sale O resultado da busca.
     */
    public function fetchByID(User $user, int $id): ?Sale
    {
        // Busca os dados das entidades relacionadas, para que o resultado seja
        // detalhado.
        $model = $this->model::with(['unit', 'seller', 'roamingUnit']);

        return match ($user->role) {
            // Pega a venda sem restrição.
            Role::GENERAL_DIRECTOR->name => $model->find($id),
            // Pega a venda se estiver dentro do intervalo de registros do
            // diretor.
            Role::DIRECTOR->name => $model->whereHas(
               'unit',
                function ($query) use ($user) {
                    $query->whereHas('division', function ($query) use ($user) {
                        $query->where('id', $user->division->id);
                    });
                }
            )->find($id),
            // Pega a venda se estiver dentro do intervalo de registros do
            // gerente.
            Role::MANAGER->name => $model->where(
                'unit_id',
                $user->managedUnit->id
            )->find($id),
            // Pega a venda se estiver dentro do intervalo de registros do
            // vendedor.
            Role::SELLER->name => $model->where(
                'seller_id',
                $user->id
            )->find($id),
            default => null
        };
    }

    /**
     * Resgata as vendas de acordo com os filtros fornecidos.
     *
     * Apesar dos filtros serem opcionais, o resgate dos registros seguem a
     * regra de restrição, de acordo com as funções (roles) dos usuários.
     *
     * @param User $user    O usuário autenticado.
     * @param array $filter Os filtros fornecidos.
     *
     * @return Collection A relação de vendas.
     */
    public function fetch(User $user, array $filter = []): Collection
    {
        return match ($user->role) {
            Role::GENERAL_DIRECTOR->name => $this->getSalesAsGeneralDirector(
                $filter
            ),
            Role::DIRECTOR->name => $this->getSalesAsDirector($user, $filter),
            Role::MANAGER->name => $this->getSalesAsManager($user, $filter),
            Role::SELLER->name => $this->getSalesAsSeller($user, $filter),
            default => []
        };
    }

    /**
     * Resgata as vendas como diretor geral.
     *
     * Esta operação não possui restrição.
     *
     * @param array $filter Os filtros a serem aplicados.
     *
     * @return Collection Todas as vendas disponíveis.
     */
    private function getSalesAsGeneralDirector(array $filter): Collection
    {
        $model = $this->model::query();

        // Filtra os resultados pela diretoria.
        if (array_key_exists('division', $filter)) {
            $model->whereHas('unit', function ($query) use ($filter) {
                $query->whereHas('division', function ($query) use ($filter) {
                    $query->where('id', $filter['division']);
                });
            });
        }

        // Adiciona os filtros genéricos.
        $this->addDefaultUnitFilter($model, $filter);
        $this->addDefaultSellerFilter($model, $filter);
        $this->addDefaultPeriodFilter($model, $filter);

        return $model->get();
    }

    /**
     * Resgata as vendas como diretor.
     *
     * Esta operação possui restrição e resgata apenas as vendas relacionadas à
     * diretoria do usuário atual.
     *
     * @param array $filter Os filtros a serem aplicados.
     *
     * @return Collection Todas as vendas disponíveis.
     */
    private function getSalesAsDirector(User $user, array $filter): Collection
    {
        $model = $this->model::query();

        // Filtra os resultados pela diretoria do usuário.
        $model->whereHas('unit', function ($query) use ($user) {
            $query->whereHas('division', function ($query) use ($user) {
                $query->where('id', $user->division->id);
            });
        });

        // Adiciona os filtros genéricos.
        $this->addDefaultUnitFilter($model, $filter);
        $this->addDefaultSellerFilter($model, $filter);
        $this->addDefaultPeriodFilter($model, $filter);

        return $model->get();
    }

    /**
     * Resgata as vendas como gerente.
     *
     * Esta operação possui restrição e resgata apenas as vendas relacionadas à
     * unidade do usuário atual.
     *
     * @param array $filter Os filtros a serem aplicados.
     *
     * @return Collection Todas as vendas disponíveis.
     */
    private function getSalesAsManager(User $user, array $filter): Collection
    {
        $model = $this->model::query();

        // Filtra os resultados pela unidade do usuário.
        $model->where('unit_id', $user->managedUnit->id);

        // Adiciona os filtros genéricos.
        $this->addDefaultSellerFilter($model, $filter);
        $this->addDefaultPeriodFilter($model, $filter);

        return $model->get();
    }

    /**
     * Resgata as vendas como vendedor.
     *
     * Esta operação possui restrição e resgata apenas vendas relacionadas ao
     * usuário atual.
     *
     * @param array $filter Os filtros a serem aplicados.
     *
     * @return Collection Todas as vendas disponíveis.
     */
    private function getSalesAsSeller(User $user, array $filter): Collection
    {
        $model = $this->model::query();

        // Filtra os resultados pelo vendedor.
        $model->where('seller_id', $user->id);

        // Adiciona os filtros genéricos.
        $this->addDefaultPeriodFilter($model, $filter);

        return $model->get();
    }

    /**
     * Adiciona um filtro comum para período (data inicial e final).
     *
     * @param Builder $model    O objeto da query.
     * @param array $filter     Os valores dos filtros.
     *
     * @return void
     */
    private function addDefaultPeriodFilter(Builder $model, array $filter): void
    {
        // Filtra os resultados por uma data inicial.
        if (array_key_exists('from', $filter)) {
            $model->where('date', '>=', $filter['from']);
        }
        // Filtra os resultados por uma data final.
        if (array_key_exists('to', $filter)) {
            $model->where('date', '<=', $filter['to']);
        }
    }

    /**
     * Adiciona um filtro comum para unidade de vendas.
     *
     * @param Builder $model    O objeto da query.
     * @param array $filter     Os valores dos filtros.
     *
     * @return void
     */
    private function addDefaultUnitFilter(Builder $model, array $filter): void
    {
        // Filtra os resultados pela unidade.
        if (array_key_exists('unit', $filter)) {
            $model->where('unit_id', $filter['unit']);
        }
    }

    /**
     * Adiciona um filtro comum para vendedor.
     *
     * @param Builder $model    O objeto da query.
     * @param array $filter     Os valores dos filtros.
     *
     * @return void
     */
    private function addDefaultSellerFilter(Builder $model, array $filter): void
    {
        // Filtra os resultados pelo vendedor.
        if (array_key_exists('seller', $filter)) {
            $model->where('seller_id', $filter['seller']);
        }
    }
}
