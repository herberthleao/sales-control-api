<?php

namespace App\Repositories;

use App\Models\User;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Repositório base.
 */
abstract class Repository
{
    /**
     * @var Model O modelo que mapeia a tabela do banco de dados.
     */
    protected Model $model;

    /**
     * Inicializa propriedades.
     *
     * @param Model $model  O modelo da tabela.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Cria um novo registro na tabela.
     * 
     * @param array $data   Os dados do registro.
     * 
     * @return Model O objeto do registro criado.
     */
    public function create(array $data): Model
    {
        return $this->model::create($data);
    }

    /**
     * Resgata registros da tabela.
     *
     * @param User $user    O usuário autenticado.
     * @param array $filter Filtros da busca.
     *
     * @return Collection Os registros encontrados.
     */
    abstract public function fetch(User $user, array $filter = []): Collection;
}
