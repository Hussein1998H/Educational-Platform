<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Course extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
         'title',
         'description',
         'start_date',
         'end_date',
    ];


    public function users():BelongsToMany{
        return $this->belongsToMany(User::class,'course_users');
    }
    public function session():HasMany{
        return $this->hasMany(Session::class,'course_id');
    }
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }
}
