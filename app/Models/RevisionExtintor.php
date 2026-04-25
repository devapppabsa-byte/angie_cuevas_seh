<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RevisionExtintor extends Model
{
    use HasFactory;

    protected $table = 'revision_extintor';
    protected $fillable=[];


    public function extintor(){
        return $this->belongsTo(Extintor::class);
    }

    public function comision(){
        return $this->belongsTo(Extintor::class);
    }

}
