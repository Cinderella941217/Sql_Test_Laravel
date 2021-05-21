<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Query extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'department',
        'author',
        'query'
    ];

    public $timestamps = false;


    public function department1() {
        return $this->belongsTo(Department::class, 'department');
    }

}
