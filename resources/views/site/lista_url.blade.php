@forelse ($urls as $u)
    <div class="row">
        @if($u->consultas->count()>0)
            @if($u->ultimaConsulta()->status != "200")
                <div class="card shadow mb-4 w-100" style="background-color: rgb(252, 201, 201)">
            @else
                <div class="card shadow mb-4 w-100")>
            @endif
        @else
            <div class="card shadow mb-4 w-100")>
        @endif

        
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-1 col-sm-12 text-center mt-1">
                        <h4><i class="fas fa-file-word"></i></h4>
                    </div>

                    <div class="col-lg-7 col-sm-12">
                        <small>url:</small>
                        <h6 class="font-weight-bold text-gray-800 mb-0">
                            {{strlen($u->url)>78 ? (substr($u->url, 0,75) . "...") : $u->url}}
                        </h6>
                    </div>

                    <div class="col-lg-3 col-sm-12">
                        <small>status da ultima consulta:</small>
                        @if($u->consultas->count()>0)
                            <h6 class="font-weight-bold text-gray-800 mb-0">{{$u->ultimaConsulta()->status}}</h6>
                        @else
                            <h6 class="font-weight-bold text-gray-800 mb-0">--</h6>
                        @endif
                    </div>

                    <div class="col-lg-1 col-sm-12 text-center ">
                        <a data-toggle="modal" data-target="#modalDelet" href="" onclick="$.clickDelet('{{$u->url}}' , 'url/{{ $u->id}}/excluir')"
                            class="btn btn-block btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                        <h4></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="row">
        <div class="card shadow mb-4 w-100">
            <div class="card-body">
                <div class="row d-flex align-items-center">
                    <div class="col text-center mt-1">
                        nenhum url cadastrado ainda.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforelse