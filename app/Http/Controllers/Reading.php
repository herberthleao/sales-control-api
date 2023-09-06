<?php

namespace App\Http\Controllers;

use App\Services\Service;

use Illuminate\Http\JsonResponse;

/**
 * Método comum para controladores que fazem leitura de recursos.
 */
trait Reading
{
    /**
     * @var Service O serviço do recurso.
     */
    protected Service $service;

    /**
     * Resgata todos os registros.
     *
     * @return JsonResponse A resposta da requisição.
     */
    public function retrieveAll(): JsonResponse
    {
        $this->data = $this->service->getAll($this->user);

        return $this->send();
    }
}
