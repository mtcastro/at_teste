@extends('layouts.app')

@section('titulo', 'Log de Consultas')

@section('main-content')
    <div class="pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Log de Consultas</h1>
    </div>

    <div class="mt-5 col-8">

        <div class="card">
            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="fas fa-clipboard-list mr-3"></i> Consultas
                    </h1>
                </div>

                <div class="row table-responsive">

                    <table class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>url</th>
                                <th>status</th>
                                <th>Tempo de Inatividade</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($consultas as $c)
                            @if($c->status != 200)
                                <tr style="background-color: rgb(252, 201, 201)">
                            @else
                                <tr>
                            @endif
                                    <td>{{ $c->created_at->format('d/m H:i')}}</td>
                                    <td>{{ $c->url->url}}</td>
                                    <td>{{ $c->status }}</td>
                                    <td>{{ $c->tempoInatividade() ? $c->tempoInatividade()->format("%d:%h:%i:%s") : '--' }}</td>
                                </tr>
                            @empty
                            <tr>
                                <td>Sem Resultados</td>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if (request()->opcao || request()->busca)
                {{ $consuluas->appends(['opcao' => request()->opcao, 'busca' => request()->busca])->links() }}
                @else
                {{ $consultas->links() }}
                @endif
            </div>
        </div>

    </div>

@endsection