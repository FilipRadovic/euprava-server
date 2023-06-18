<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IdentificationDocumentType extends Model
{
    use HasFactory;

    protected $table = 'identification_document_types';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'type'
    ];
}
