
@extends('layouts.baseLogin')
@section('title','error 404')

@section('content')
    
    <section class="content">
          <div class="error-page " style="margin-top:16%;">
            <h2 class="headline text-info"> 404</h2>

            <div class="error-content">
              <h3><i class="fas fa-exclamation-triangle text-info"></i> ¡Ups! Página no encontrada.</h3>

              <p>
               No pudimos encontrar la página que estabas buscando. Mientras tanto, puede
                <a href="/">volver al menu de inicio Option2health</a> 
              </p>

            
            </div>
            <!-- /.error-content -->
          </div>
          <!-- /.error-page -->
        </section>

@endsection


