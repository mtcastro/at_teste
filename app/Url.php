<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    public function consultas()
    {
        return $this->hasMany('App\Consulta');
    }

    public function ultimaConsulta()
    {
        return Consulta::with('url')->where('url_id', $this->id)->orderBy('created_at', 'desc')->first();
    }
}
