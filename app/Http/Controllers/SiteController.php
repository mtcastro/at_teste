<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Url;
use App\Consulta;
use App\Config;
use App\Mail\newNotificacaoInatividade;
use App\Mail\newNotificacaoRetornoUrl;
use App\Jobs\newConsultaUrl;

class siteController extends Controller
{
    public function index()
    {
        $config = Config::where("id", "1")->first();
        $ultimaConsulta = Consulta::with('url')->orderBy('created_at','desc')->first();
        return view('site.home', [
            'urls'=>Url::with('consultas')->orderBy('created_at','desc')->get(),
            'config' => $config,
            'ultimaConsulta' => $ultimaConsulta
        ]);
    }

    public function cadastrarUrl(Request $request){
        $url = new Url();
        $url->url = $request->input('url');
        $url->save();
        return view('site.lista_url', ['urls'=>Url::with('consultas')->orderBy('created_at','desc')->get()]);
    }

    public function logConsultas(){
        return view('site.log_consultas', ['consultas'=>Consulta::with('url')->orderBy('created_at','desc')->paginate(25)]);
    }

    public function destroy($id){
        DB::beginTransaction();
        try {
            $url = Url::findOrFail($id);
            $consultas = $url->consultas;

            foreach ($consultas as $c) {
                $c->delete();
            }
            $url->delete;

        } catch (Throwable $th) {
            DB::rollBack();
            request()->flash();
            return redirect()->back()->with('mensagem', 'Falha ao excluir Url');
        }
        DB::commit();
        return redirect()->route('home')->with('mensagem', 'Url excluido com Sucesso!');
    }

    public function cadastrarEmail(Request $request)
    {
        $config = Config::where("id", "1")->first();
        if(!$config) 
            $config = new Config();

        $config->email = $request->input('email');
        $config->save();
    }

    public function notificacao()
    {
        $config = Config::where("id", "1")->first();
        return view('site.notificacao', ['config'=>$config]);
    
    }

    public function mail()
    {
        $u = $url = Url::findOrFail('2');
  
        if($u->ultimaConsulta() != null){
            if($u->ultimaConsulta()->status == "200") //evitar duplicação de verificação da recusividade de verificação
                newConsultaUrl::dispatch($u);
        }
        else
            newConsultaUrl::dispatch($u);
    }
}
