<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Developer extends Model
{
    use SoftDeletes;
    protected $table = 'developers';

    protected $dates = [
        'created_at',
        'updated_at',
        'datanascimento'
    ];

    protected $fillable = [
        'nome',
        'sexo',
        'idade',
        'hobby',
        'datanascimento'
    ];

    public function scopeNome($query, $name = null)
    {
        if (!is_null($name)) {
            $query->where('nome', 'like', '%'.$name.'%');
        }
    }

    public function scopeSexo($query, $sex = null)
    {
        if (!is_null($sex)) {
            $query->where('sexo', $sex);
        }
    }

    public function scopeIdade($query, $age = null)
    {
        if (!is_null($age)) {
            $query->where('idade', $age);
        }
    }

    public function scopeDataNascimento($query, $dateBirth = null)
    {
        if (!is_null($dateBirth)) {
            $query->where('datanascimento', $dateBirth);
        }
    }

    public function scopeHobby($query, $hobby = null)
    {
        if (!is_null($hobby)) {
            $query->where('hobby', 'like', '%'.$hobby.'%');
        }
    }

    public function scopeExcluido($query, $deleted){
        if((!is_null($deleted)) && ($deleted == true)){
            $query->withTrashed();
        }
    }
}
