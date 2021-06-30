@extends('layouts.app')

@section('titulo', 'Inicio')

@section('main-content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Inicio</h1>
    </div>

    <div>
        <div class="row">
        
        <div class="col-8 border-right">
            <div style="width: 98%">
                <div class="mt-3 row">
                    <h6>Adicionar URL para monitoramento</h6>
                </div>
                <div class="row input-group">
                    <input type="text" class="form-control" id="t_url" placeholder="hrl" aria-label="Recipient's username" aria-describedby="btn-enviar">
                    <div class=" input-group-append">
                        <button class=" btn btn-outline-primary" type="submit" id="btn-enviar"><i class="fas fa-paper-plane"></i></button>
                    </div>
                </div>

            </div>   

            <div class="mt-5 " style="width: 98%">
                <div class="row mb-3">
                    <h6>Sites monitorados</h6>
                </div>

                <div id="lista_url">
                    @include('site.lista_url');
                </div>

            </div>

        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-4">
            <div class="card border-left-success shadow py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Email de Notificação:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$config ? $config->email : "nenhum email cadastrado"}}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card border-left-success shadow py-2 mt-5">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ultima Verificação:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$ultimaConsulta ? $ultimaConsulta->created_at->format('d/m/Y H:i') : "--" }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>

        
    </div>

    <div class="modal fade" id="modalDelet" tabindex="-1" aria-labelledby="modalConfig">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title font-weight-bold">ATENÇÃO </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                <div class="modal-body" id='msg'>
                    Tem certeza que deseja deletar esta url?
                </div>
               
                <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-primary">Cancelar</button>
                    <a id="botao-delet" href=""
                        class="btn  btn-danger">
                        <i class="fas fa-trash-alt"></i> Deletar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection