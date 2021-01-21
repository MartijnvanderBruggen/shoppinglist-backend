<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Knowledgebase extends Model
{
    use HasFactory;
    protected $table = 'knowledgebase_articles';
    protected $fillable = ['title','content'];

}
