<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Modelo de venda.
 */
final class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'value',
        'latitude',
        'longitude',
        'seller_id',
        'unit_id',
        'roaming_unit_id'
    ];

    /**
     * A unidade desta venda.
     *
     * @return BelongsTo Relacionamento da unidade.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * A unidade de venda em roaming (se houver).
     *
     * @return BelongsTo Relacionamento da unidade roaming.
     */
    public function roamingUnit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    /**
     * O vendedor desta venda.
     *
     * @return BelongsTo Relacionamento do vendedor.
     */
    public function seller(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
