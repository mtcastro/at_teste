@extends('layouts.app')

@section('titulo', 'Inicio')

@section('main-content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Notificações</h1>
    </div>

    <div class="row ">
        <div class="col-4 mt-2">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Email de Notificação:</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="t_email">{{$config ? $config->email :"nenhum email cadastrado"}}</div>
                        </div>
                    </div>
                </div>
            </div>
         </div>

         
        <div class="col-4"style="width: 98%">
            <div class="mt-3 row">
                <h6>Adicione email para configurar o email de notificações:</h6>
            </div>
            <div class="row input-group">
                <input type="e-mail" class="form-control" id="i_email" placeholder="e-mail" aria-label="Recipient's username" aria-describedby="btn-enviar">
                <div class=" input-group-append">
                    <button class=" btn btn-outline-primary" type="submit" id="btn-enviar-email"><i class="fas fa-paper-plane"></i></button>
                </div>
            </div>

        </div>
    </div>

@endsection