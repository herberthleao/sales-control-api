<?php

namespace App\Enums;

/**
 * Relação das funções do usuários.
 *
 * Essas funções são responsáveis por determinar o controle de acesso dos
 * usuários.
 */
enum Role
{
    case GENERAL_DIRECTOR;
    case DIRECTOR;
    case MANAGER;
    case SELLER;
}
