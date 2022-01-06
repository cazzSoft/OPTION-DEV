
<!DOCTYPE html>
<html lang="en">
<head>
  @section('plugins.Select2',true)
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>O2H | Login</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('/vendor/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('/vendor/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('/vendor/adminlte/dist/css/adminlte.min.css')}}">
  {{-- select2 --}}
  <link rel="stylesheet" href="{{asset('/vendor/select2/css/select2.min.css')}}"> 
   <link rel="stylesheet" href="{{asset('/vendor/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
   
  <div class="card card-outline card-purple ">
    <div class="card-header text-center">
        <img src="{{url('/vendor/adminlte/dist/img/acroxa.png')}}" alt="User Image"><br>
      <a class="h1"><b>Acro</b>xa</a>
    </div>
    <form method="POST" action="{{ route('validateRol') }}">
        @csrf
        <div class="card-body">
          <p class="login-box-msg">{{auth()->user()->username}}</p>
            <div class="form-group">
               <div class="select2-purple">
                 <select class="select2 form-control-sm"  data-placeholder="Seleccione rol" name="idrol"   data-dropdown-css-class="select2-purple" style="width: 100%;" required >
                    <option></option>
                    @if(isset($listaRoles))
                      @foreach($listaRoles[0]['rol'] as $rol)
                          <option value="{{$rol->idrol}}">{{$rol->descripcion}}</option>
                      @endforeach
                    @endif
                   
                 </select>
               </div>
             </div>   
        </div>
        <div class="card-footer">
            <div class="social-auth-links text-center mt-2 mb-3">
                 <button type="submit" class="btn btn-block bg-purple "><i class="fa fa-arrow-alt-circle-up"></i> Aceptar</button>
            </div>
        </div>
    </form>  
    <a class="btn btn-block btn-light" href="{{ route('logout') }}" 
        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();
                ">
        <i class="fa fa-reply"></i> Canselar
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
       

    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('/vendor/adminlte/dist/js/adminlte.min.js')}}"></script>
{{-- select2 --}}
<script src="{{asset('/vendor/select2/js/select2.full.min.js')}}"></script>
<script src="{{asset('/vendor/adminlte/dist/js/adminlte.min.js')}}"></script>

<script>
    $(function() {
       $('.select2').select2();

    });
</script>
</body>
</html>
</div> 