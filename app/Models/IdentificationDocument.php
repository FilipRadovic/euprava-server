<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IdentificationDocument extends Model
{
    use HasFactory;

    protected $table = 'identification_documents';
    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'document_number',
        'type_id',
        'registration_id'
    ];

    public function image(): HasOne {
        return $this->hasOne(IdentificationDocumentImage::class, 'identification_document_id');
    }

    public function type(): BelongsTo {
        return $this->belongsTo(IdentificationDocumentType::class, 'identification_document_type_id');
    }

    public function registration(): BelongsTo {
        return $this->belongsTo(Registration::class, 'registration_id');
    }
}
