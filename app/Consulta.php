<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Consulta extends Model
{
    public function url()
    {
        return $this->belongsTo('App\Url');
    }

    public function tempoInatividade()
    {
        if($this->status == "200" || $this->time_return == null)
            return null;
        $time_return = Carbon::create($this->time_return);  
        return $time_return->diff($this->created_at);

    }
}
