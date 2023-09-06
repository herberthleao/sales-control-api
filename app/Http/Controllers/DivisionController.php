<?php

namespace App\Http\Controllers;

use App\Services\DivisionService;

/**
 * Controlador das diretorias.
 */
final class DivisionController extends Controller
{
    use Reading;

    /**
     * Inicializa propriedades.
     *
     * @param DivisionService $service  O serviço das diretorias.
     */
    public function __construct(DivisionService $service)
    {
        parent::__construct();

        $this->service = $service;
    }
}
