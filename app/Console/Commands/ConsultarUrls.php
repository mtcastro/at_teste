<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Url;
use App\Consulta;
use App\Jobs\newConsultaUrl;

class ConsultarUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consultar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $urls = Url::all();

        foreach ($urls as $key => $u) {
            if($u->ultimaConsulta() != null){
                if($u->ultimaConsulta()->status == "200") //evitar duplicação de verificação da recusividade de verificação
                    newConsultaUrl::dispatch($u);
            }
            else
                newConsultaUrl::dispatch($u); 
        }
    }
}
