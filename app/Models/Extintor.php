<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extintor extends Model
{
    use HasFactory;

    protected $table = 'extintores';
    protected $fillable = [];



    public function revision_extintor(){
        return $this->hasMany(RevisionExtintor::class);
    }

}
