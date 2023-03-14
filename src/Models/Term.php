<?php

namespace Laboiteacode\RGPDManager\Models;

use Illuminate\Database\Eloquent\Model;
use GrahamCampbell\Markdown\Facades\Markdown;

class Term extends Model
{
    protected $guarded = [];

    public $fillable = ['title', 'excerpt', 'content', 'icon'];

    public function getContentParsedAttribute()
    {
        return config('rgpdmanager.use_markdown') ? Markdown::convert($this->content)->getContent() : $this->content ;
    }
}