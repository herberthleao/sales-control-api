<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

/**
 * Modelo de usuário.
 */
final class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'unit_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * A diretoria que o usuário dirige (se for um diretor).
     *
     * @return HasOne Relacionamento da diretoria.
     */
    public function division(): HasOne
    {
        return $this->hasOne(Division::class, 'director_id');
    }

    /**
     * A unidade de vendas que o usuário gerencia (se for um gerente).
     *
     * @return HasOne Relacionamento de unidade.
     */
    public function managedUnit(): HasOne
    {
        return $this->hasOne(Unit::class, 'manager_id');
    }

    /**
     * A unidade de vendas ao qual o usuário pertence (se for um vendedor).
     *
     * @return BelongsTo Relacionamento de unidade.
     */
    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
