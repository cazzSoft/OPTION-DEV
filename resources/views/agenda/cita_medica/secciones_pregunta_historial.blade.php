<div class="row m-0">
  <div class="col-sm-12">
    @if(isset($datos_sgd['datos_cita_last']['lista_seccion']))
      @foreach($datos_sgd['datos_cita_last']['lista_seccion'] as $key=>$item_h)
        <dt>
          <span class="text-seccion"> {{ $item_h->titulo}}</span>
          <span class="text-info_ text-decoration  btn" onclick="traer_p_h('{{encrypt($item_h->idsecciones)}}','{{$key}}',this)" > <u>Ver más</u></span>
          <input type="hidden"  id="seccion_h{{$key}}">
        </dt> 
        {{--sub seccion preguntas  --}}
        <div class="row col-sm-12 seccion_h{{$key}} d-none  @movil prengunta-text @else p-2 @endmovil" >
        </div>  
      @endforeach
    @endif
  </div>
</div>