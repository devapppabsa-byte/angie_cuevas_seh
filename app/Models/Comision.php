<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Comision extends Model implements Authenticatable
{

    use AuthenticatableTrait;
    use HasFactory;

    protected $table = 'comision';
    protected $fillable = [];


    public function revision_extintor(){
        return $this->hasMany(RevisionExtintor::class);
    }


}
