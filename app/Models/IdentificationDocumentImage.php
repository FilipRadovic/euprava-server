<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IdentificationDocumentImage extends Model
{
    use HasFactory;

    protected $table = 'identification_document_images';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'image'
    ];
}
