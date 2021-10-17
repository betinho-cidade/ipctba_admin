@extends('painel.layout.index')


@section('content')

@if ($errors->any())
    <div class="row">
        <div class="col-12">
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
        </div>
    </div>
@endif

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Indicadores - IPCTBA</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">

        <!-- Tipo do Membro - INI -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Tipo dos Membros <code>({{$graph_total['tipo']}})</code></h4>
                    <div id="div_tipo_membro"></div>
                </div>
            </div>
        </div>
        <!-- Tipo do Membro - FIM -->

        <!-- Status Participação - INI -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Status de Participação <code>({{ $graph_total['participacao'] }})</code></h4>
                    <div id="div_status_participacao"></div>
                </div>
            </div>
        </div>
        <!-- Status Participação - FIM -->

        <!-- Ativo/Inativo - INI -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Cadastros Ativos/Inativos <code>({{ $graph_total['ativo'] }})</code></h4>
                    <div id="div_ativo"></div>
                </div>
            </div>
        </div>
        <!-- Ativo/Inativo - FIM -->

    </div>


    <!-- Carrosel - Aniversariantes - INI -->
    <div class="row">
        <div class="col-lg-12">
            <h4 class="card-title">Aniversariantes da Semana - {{$periodo}}</h4>
            <div class="progress progress-sm animated-progess" style="height: 1px;">
                <div class="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <p></p>

    <div class="row">
    @forelse($aniversariantes as $membro )
        <div class="col-lg-3">
            <div id="todo-task" class="task-list">
                <div class="card task-box">
                    <div class="progress progress-sm animated-progess" style="height: 3px;">
                        <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>

                    <a href="{{route('membro.show', compact('membro'))}}">
                    <div class="card">
                        <div class="row no-gutters align-items-topr">
                            <div class="col-md-4">
                                <img class="card-img img-fluid" src="{{$membro->imagem}}" alt="Card image">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <span class="float-right" style="font-size: 12px; color: gray">{{$membro->idade}}</span>
                                    <h5 class="card-title">{{utf8_encode($membro->data_nascimento_dia_mes)}}</h5>
                                    <p class="card-text">{{$membro->nome}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    </a>

                </div>
            </div>
        </div>
    @empty
        <div class="col-lg-3">
            Nenhum aniversariante na semana
        </div>
    @endforelse
    </div>
    <!-- Carrosel - Aniversariantes - FIM -->

@endsection

@section('head-css')
@endsection


@section('script-js')

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Situação', 'qtde'],
          @foreach ( $graph_ativos as $graph_ativo )
            ['{{$graph_ativo['status']}}', {{$graph_ativo['qtde']}}],
          @endforeach
        ]);

        var options = {
          pieHole: 0.4,
          chartArea:{left:5,top:20,width:'100%',height:'100%'},
          is3D:true,
          fontSize:12,
          pieSliceText: 'value',
          legend:{position: 'right', textStyle:{fontSize:12}},
        };

        var chart = new google.visualization.PieChart(document.getElementById('div_ativo'));
        chart.draw(data, options);
      }
    </script>

    <script type="text/javascript">
        google.charts.load("current", {packages:["corechart"]});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ['Tipo', 'qtde'],
            @foreach ( $graph_tipos as $graph_tipo )
            ['{{$graph_tipo['tipo']}}', {{$graph_tipo['qtde']}}],
            @endforeach
          ]);

          var options = {
            pieHole: 0.4,
            chartArea:{left:5,top:20,width:'100%',height:'100%'},
            is3D:true,
            fontSize:12,
            pieSliceText: 'value',
            legend:{position: 'right', textStyle:{fontSize:12}},
          };

          var chart = new google.visualization.PieChart(document.getElementById('div_tipo_membro'));
          chart.draw(data, options);
        }
      </script>

      <script type="text/javascript">
          google.charts.load("current", {packages:["corechart"]});
          google.charts.setOnLoadCallback(drawChart);
          function drawChart() {
            var data = google.visualization.arrayToDataTable([
              ['Status Participação', 'qtde'],
              @foreach ( $graph_participacaos as $graph_participacao )
              ['{{$graph_participacao['participacao']}}', {{$graph_participacao['qtde']}}],
              @endforeach
            ]);

            var options = {
              pieHole: 0.4,
              chartArea:{left:5,top:20,width:'100%',height:'100%'},
              is3D:true,
              fontSize:12,
              pieSliceText: 'value',
              legend:{position: 'right', textStyle:{fontSize:12}},
            };

            var chart = new google.visualization.PieChart(document.getElementById('div_status_participacao'));
            chart.draw(data, options);
          }
        </script>

@endsection


