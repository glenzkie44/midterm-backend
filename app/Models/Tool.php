<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'description',
        'price',
        'acquired_on',
        'contained_on',
    ];

    public function container() {
        return $this->belongsTo('App\Models\Tool', 'contained_on', 'id');
    }
}
