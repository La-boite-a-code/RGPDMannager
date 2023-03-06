<?php

namespace Laboiteacode\RGPDManager\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $guarded = [];

    public $fillable = ['title', 'excerpt', 'content'];
}