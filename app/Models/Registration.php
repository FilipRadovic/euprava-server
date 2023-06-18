<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    use HasFactory;
    use HasUuids;

    protected $table = 'registrations';
    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        'status',
        'firstname',
        'lastname',
        'jmbg',
        'username',
        'email',
        'password'
    ];


    protected $hidden = [
        'password'
    ];

    public function document(): HasOne {
        return $this->hasOne(IdentificationDocument::class, 'registration_id');
    }

    public function city(): BelongsTo {
        return $this->belongsTo(City::class, 'city_id');
    }
}
