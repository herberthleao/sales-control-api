<?php

namespace App\Services;

use App\Models\Unit;

/**
 * Serviço de geolocalização.
 */
final class GeolocationService extends Service
{
    /**
     * @var Unit Modelo de unidades de vendas.
     */
    private Unit $unit;

    /**
     * Inicializa propriedades.
     *
     * @param Unit $unit    O modelo de unidades de vendas.
     */
    public function __construct(Unit $unit)
    {
        $this->unit = $unit;
    }

    /**
     * Resgata a unidde mais próxima da localização fornecida.
     *
     * @param array $location   As coordenadas da localização.
     *
     * @return Unit A unidade de vendas mais próxima.
     */
    public function getNearestUnit(array $location): Unit
    {
        // Query para realiza o cálculo da distância das unidades, em relação à
        // localização fornecida, pegando a que possui a menor distância.
        $select = <<< SQL
        *,
        ST_DISTANCE_SPHERE(
            POINT(?, ?),
            POINT(latitude, longitude)
        ) AS distance
SQL;
        $model = $this->unit::selectRaw($select, $location);
        $model->orderBy('distance');

        return $model->first();
    }
}
