<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Url;
use App\Consulta;
use Carbon\Carbon;
use App\Mail\newNotificacaoInatividade;
use App\Mail\newNotificacaoRetornoUrl;
use App\Config;

class newConsultaUrl implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $url;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Url $url )
    {
        
        $this->url = $url;
    }

    /**
     * Esse trabalho sera empilhado novamente toda vez que houver um codigo diferente de 200 
     * em uma consulta http de um url. Quando for igual a 200 esse metodo verifica se a ultima
     * consulta dacastrada para aquela url foi diferente de 200, caso sim ele calcula o tempo de
     * inatividade e registra na mesma consulta, caso for igual a 200 ele regisra a nova consulta 
     * com tempo de inatividade nula.
     *
     * @return void
     */
    public function handle(){
        
        $ch = curl_init($this->url->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        

        if( $code != "200"){
            
            if ($this->url->ultimaConsulta() != null){
                if($this->url->ultimaConsulta()->status != "200") //aqui verifica se o url já não estava fora do ar para não duplicar informação
                    newConsultaUrl::dispatch($this->url)->delay(now()->addSeconds('15'));// Envia a requisição para fila novamente para ser processada daqui a 15 segundos
                else //detectou uma mudança de status e cria uma consulta
                    $this->mudaStatus($code);
            }
            else //detectou uma mudança de status e cria uma consulta
                $this->mudaStatus($code);
        }
        else{
            if ($this->url->ultimaConsulta() != null){
                if($this->url->ultimaConsulta()->status != "200"){//aqui identifica que a url voltou ao status 200 e calcula o tempo de inatividade e registra
                    
                    $consulta = $this->url->ultimaConsulta();
                    $consulta->time_return = Carbon::now(); 
                    $consulta->save();

                    $config = Config::where("id", "1")->first();
                    if($config!=null)
                        Mail::send(new newNotificacaoRetornoUrl($this->url->ultimaConsulta(), $config->email));
        
                    //enviar um email dizendo que a url voltou ao ar e indicar o tempo de inatividade;
                }
            }
            $consulta = new Consulta();
            $consulta->url_id = $this->url->id;
            $consulta->status = $code;
            $consulta->time_return = null;
            $consulta->save(); 
        }
    }

    public function mudaStatus($status)
    {
        $consulta = new Consulta();
        $consulta->url_id = $this->url->id;
        $consulta->status = $status;
        $consulta->time_return = null;
        $consulta->save();

        //enviar um email dizendo que a url saiu do ar
        $config = Config::where("id", "1")->first();
        if($config!=null)
            Mail::send(new newNotificacaoInatividade($this->url->ultimaConsulta(), $config->email));
        
        newConsultaUrl::dispatch($this->url)->delay(now()->addSeconds('15'));// Envia a requisição para fila novamente para ser processada daqui a 15 segundos
    
    }
}
