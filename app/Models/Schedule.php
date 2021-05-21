<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'query',
        'time',
        'subject',
        'reoccurring'
    ];

    public $timestamps = false;
}