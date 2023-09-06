<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Modelo de unidade de venda.
 */
final class Unit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'latitude',
        'longitude',
        'manager_id',
        'division_id'
    ];

    /**
     * Diretoria a qual esta unidade pertence.
     *
     * @return BelongsTo Relacionamento da diretoria.
     */
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }

    /**
     * Vendedores desta unidade.
     *
     * @return HasMany Relacionamento de vendedores.
     */
    public function sellers(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
