@extends('painel.layout.index')

@section('content')

    <div class="row">
        <div class="col-lg-4">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Agenda IPCTBA</h4>
            </div>
        </div>

        <div class="col-lg-8 align-items-left">
            @foreach($agenda_meses as $key => $value)
            <button type="button" onClick="javascript:location.href='{{ route('agenda.index', ['anomes' => $key]) }}'" class="btn btn-light btn-sm waves-effect waves-light">{{ $value }}</button>
            @endforeach
        </div>

    </div>


    @if($agendas)
    @foreach($agendas as $ano_mes => $lista_agenda )
        <div class="row">
            <div class="col-lg-12">
                <h4 class="card-title">{{ $ano_mes }}</h4>
                <div class="progress progress-sm animated-progess" style="height: 1px;">
                    <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
        <p></p>

        <div class="row">
        @foreach($lista_agenda as $agenda )
            <div class="col-lg-3 {{ $agenda['status'] == 'CL' ? 'box-agenda-inativo' : '' }} ">
                <div id="todo-task" class="task-list">
                    <div class="card task-box {{ $agenda['status'] == 'CL' ? 'bg-light' : '' }}">
                        <div class="progress progress-sm animated-progess" style="height: 3px;">
                            <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        @php $agenda_solicitacao = $agenda['historico_solicitacao_obj']; @endphp
                        <a href="{{route('agenda_solicitacao.show', compact('agenda_solicitacao'))}}">
                        <div class="card-body">
                            <div class="float-end ms-2">
                                <div>
                                    <span class="float-right" style="font-size: 14px;color: blue;">{{ $agenda['lider'] }}</span>
                                    <h6 class="card-title">{{ $agenda['data'] }}</h6>
                                </div>
                            </div>
                            <div class="mb-3">
                                {{ $agenda['membro'] }}
                            </div>
                            <div style="overflow: auto; max-height: 75px;">
                                <h5 class="font-size-16"><span class="text-dark">{{ $agenda['tipo_solicitacao'] }}</span></h5>
                                <p class="mb-4">{{ $agenda['comentario'] }}</p>
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
    @endforeach
    @else
        Não foram encontradas agendas registradas para os próximos dias.
    @endif

@endsection


@section('head-css')
@endsection


@section('script-js')
@endsection
