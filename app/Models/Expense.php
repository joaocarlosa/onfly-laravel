<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Expense extends Model
{
    use HasFactory;

    protected $table = 'expense';
    protected $fillable = ['description', 'user_id', 'value'];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if(auth()->check()){
                $builder->where('user_id', auth()->id());
            }
        });
    }
}
