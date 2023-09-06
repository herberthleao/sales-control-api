<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de diretoria.
 */
final class Division extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'director_id'
    ];

    /**
     * As unidades de vendas desta diretoria.
     *
     * @return HasMany Relacionamento das unidades.
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }
}
