<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Social extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'phone',
        'Whatsapp',
        'linkein',
        'gitHub',
        'facebook',
    ];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
}
