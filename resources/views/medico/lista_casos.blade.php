<div class="row ">
  <div class="col-md-2 mb-2 mt-3">
    <div class="btn-group b" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Filtrar
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          
            <a class="dropdown-item" href="{{url('gestion/last_month')}}">Ultimo mes</a>
            <a class="dropdown-item" href="{{url('gestion/user_casos')}}">Mis casos</a>
            <a class="dropdown-item" href="{{url('medico/casos_ex')}}">Todos</a>

        </div>
    </div>
  </div>
  <div class="col-md-10 mt-3">
    <form action="{{url('gestion/search_caso')}}" method="POST">
      {{ csrf_field() }}
      <input id="method_" type="hidden" name="_method" value="POST">                  
      <div class="input-group  ">
        <input type="Search" class="form-control" name="search_caso" value="@if(isset($valor)) {{$valor}} @endif" >
        <div class="input-group-append">
           <button class="input-group-text " type="submit"> <i class="fas fa-search"></i> </button>
        </div>
      </div>
    </form> 
  </div>

  <div class="col-12">
    <h4 class="my-3">Casos recientes</h4>
      @if(isset($lista_casos))
        @foreach($lista_casos as $item)
          <div class="post callout clearfix callout-info ">
            <div class="user-block comment-text">
              <img class="img-circle img-bordered-sm" src="{{asset('ava1.png')}}" alt="User Image">
              <span class="username">

                <a href="{{url('gestion/caso/'.$item->idarticulo_encryp)}}" class="text-primary font-weight-bold deco-none" style="text-decoration: none;cursor: pointer;">{{$item['titulo']}}</a>
                @if(auth()->user()->id==$item['iduser'])<button class="btn btn-xs btn-outline-info text-ligth rounded float-right" onclick="get_caso('{{$item->idarticulo_encryp}}',this)"> <i class="fas fa-pen-alt text-ligth"></i> </button> @endif
              </span> 
              <span class="description">{{$item['medico'][0]['name']}} - {{$item->created_at->isoFormat('lll')}}</span>
            </div>
            <p>
             {{$item['descripcion']}}
            </p>
            <p class="mb-2">
              <span class=" text-sm mb-4"><i class="fas fa-eye mr-1"></i> visto {{$item['visto']}}</span>
              <span class=" text-sm ml-3"> <i class="far fa-comments mr-1"></i> Comments {{$item['comentarios_count']}}</span>
            </p>
          </div>
        @endforeach
          <div class="form-group text-center">
              {{ $lista_casos->links() }}
          </div>

          
         
      @else
        <div class="alert alert-light  " role="alert">
          Aún no tenemos ningún caso excepcional publicado. Puedes ser le primero y publicar uno.
        </div>
      @endif
      
  </div>

</div>