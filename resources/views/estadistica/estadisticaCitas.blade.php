@extends('homeOption2h')
@section('title','Estadisticas')

@section('plugins.Select2',true)
@section('plugins.Chartjs',true)
{{-- @section('plugins.Sweetalert2',true) --}}


{{-- cuerpo de la pagina --}}
@section('contenido')
  <div class="row ">
    <div class=" text-center  @movil col-6 @else mt-5 p-5 col-3 @endmovil">
      <select class="form-control select2" data-placeholder="Seleccione un año"  id="año_estadistica"  name="año_estadistica" >
       <option value="{{date('Y')}}">Año actual</option>
       <option value="{{date('Y')-1}}">{{date('Y')-1}}</option>
       <option value="{{date('Y')-2}}">{{date('Y')-2}}</option>
      </select>
    </div>
  </div>

  <div class="row @movil mt-3  @else pl-5 pr-5 @endmovil">
    <div class="text-left  @movil col-12 @else  col-md-8 col-sm-12 pl-2 pr-5 @endmovil" >
      <p class="text-title">Citas reservadas</p>
      <div class="title-content  @movil @else mr-5 @endmovil">
        <span class="text-num"> @if(isset($total_citas)) {{$total_citas}} @else 0 @endif</span>
        <span class="description-increment ml-2 pl-3 pr-3 ">
          <i class="fa-solid fa-arrow-up"></i> @if(isset($crecimiento)) {{$crecimiento}}% @else 0% @endif 
        </span>
        <span class="float-right btn btn-sm btn-default mt-2 "> Mensual</span>
      </div>

      <!-- STACKED BAR CHART -->
      <div class="card card-success shadow-none  @movil @else mr-5 @endmovil">
        <div class="card-body p-0">
          <div class="chart">
            <canvas id="stackedBarChart" style="min-height: 250px; height: 340px; max-height: 650px; max-width: 100%;"></canvas>
          </div>
          
        </div>
        <!-- /.card-body -->
      </div>
    </div>

    <div class="text-left @movil col-12 @else  col-md-4 col-sm-12 pl-2 pr-1 @endmovil" >
      <p class="text-title">Citas reservadas online</p>
      <span class="text-num"> @if(isset($citas_online)) {{$citas_online}} @else 0 @endif  citas</span>
      <p>reservadas online por sus pacientes</p>
      <br>
      <p>Cuándo se reservaron</p>
      <div class="row ">
        <div class="col @movil text-center @endmovil">
          <span class="text-perceng">@if(isset($cita_dentro_horario)) {{$cita_dentro_horario}} @else 0 @endif %</span><br>
          <span class="text">Fuera del horario de trabajo</span>
        </div>
        <div class="col @movil text-center @endmovil ">
          <span class="text-perceng text-center">@if(isset($cita_fuera_horario)) {{$cita_fuera_horario}} @else 0 @endif %</span><br>
          <span class="text">En horario de trabajo</span> 
        </div>
      </div>
      <br>
      <p>Dónde se reservaron</p>
      <div class="row">
        <div class="col">
          <div class="row ">
            <div class="col-9">
              <div class="progress progress-sm">
                <div class="progress-bar " role="progressbar" style="width: {{$prct_o2h}}%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">O2H</div> 
              </div>
            </div>
            <div class="col text-center m-auto text-por">@if(isset($prct_o2h)) {{$prct_o2h}} @else 0 @endif %</div>
          </div> 
          <div class="row mt-2">
            <div class="col-9">
              <div class="progress progress-sm">
                <div class="progress-bar " role="progressbar" style="width: {{$prct_cnsl}}%;" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">Su consultorio</div> 
              </div>
            </div>
            <div class="col- text-center m-auto text-por">@if(isset($prct_cnsl)) {{$prct_cnsl}} @else 0 @endif %</div>
          </div>
          <div class="row mt-2">
            <div class="col-9">
              <div class="progress progress-sm">
                <div class="progress-bar " role="progressbar" style="width: {{$prct_bzn}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Buzón de voz</div> 
              </div>
            </div>
            <div class="col text-center m-auto text-por">@if(isset($prct_bzn)) {{$prct_bzn}} @else 0 @endif %</div>
          </div>
          <div class="row mt-2">
            <div class="col-9">
              <div class="progress progress-sm">
                <div class="progress-bar " role="progressbar" style="width: {{$prct_cmp}}%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">Campañas</div> 
              </div>
            </div>
            <div class="col text-center m-auto text-por">@if(isset($prct_cmp)) {{$prct_cmp}} @else 0 @endif %</div>
          </div>
        </div>
      </div>
    </div>
  </div>
@stop

{{-- Seccion para insertar css--}}
@section('include_css') 
  {{-- estadisticaCitas css --}}
  <link rel="stylesheet" href="{{ asset('css/estadisticaCita.css') }}">
@stop 



{{-- Seccion para insertar js--}}
@section('include_js')
  <!-- ChartJS -->
  <script src="{{ asset('/js/estadisticaCita.js') }}"></script>
  @if(isset($areaChartData))
    <script type="text/javascript"> 
       const data_ = @json($areaChartData);       
    </script>
  @endif
@stop