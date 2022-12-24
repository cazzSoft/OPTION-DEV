<div class="row m-0">
  <div class="col-sm-12">
    @if(isset($lista_seccion))
      @foreach($lista_seccion as $key=>$item_s)
          <dt>
            <span class="text-seccion"> {{ $item_s->titulo}}</span>
            <span class="text-info_ text-decoration  btn" onclick="traer_p('{{encrypt($item_s->idsecciones)}}','{{$key}}',this)" > <u>Ver más</u></span>
            <input type="hidden" id="seccion_{{$key}}">
          </dt> 

          {{--sub seccion preguntas  --}}
          <div class="row col-sm-12 seccion_{{$key}} d-none  @movil prengunta-text @else p-2 @endmovil" >
          </div>  
      @endforeach
    @endif
  </div>
</div>