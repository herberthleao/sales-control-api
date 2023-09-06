<?php

namespace App\Services;

use App\Exceptions\ClientException;

use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Serviço base.
 */
abstract class Service
{
    /**
     * Formata o resultado.
     *
     * Se for um vetor, o resultado recebe o valor total de registros.
     *
     * @param Collection|array|Model|null $result   Os dados a serem formatados.
     * @param bool $counter                         Habilita a contagem de
     * registros.
     *
     * @return array O resultado da formatação.
     */
    protected function prepareForSuccess(
        Collection|array|Model|null $result,
        bool $counter = false
    ): array {
        $response = [
            'data' => $result
        ];

        if ($counter && is_countable($result)) {
            // Contabiliza o total de registros.
            $response['total'] = count($result);
        }

        return $response;
    }

    /**
     * Prepara o resultado em caso de falha.
     *
     * @param string $message   A mensagem do erro.
     * @param int $status       O código de status do erro.
     *
     * @throws ClientException se houve falha.
     *
     * @return array Valor não retornado.
     */
    protected function prepareForFailure(string $message, int $status): array
    {
        throw new ClientException($message, $status);
    }
}