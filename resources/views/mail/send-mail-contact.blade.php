<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <title>Contact Option2Health</title>

  <style type="text/css">
    body{
      margin: auto;

    }
    .content{
      /*position: absolute;*/
      width: 606px;
      height: 645px;
      margin: auto;
      border: 1px solid #EAECEE;
      text-align: center;  
    }
    .imagenIcon{
       width: 50%;
       height: 90px;
      
       text-align: center;
    }
    .nav{
     border-bottom: 3px solid #0FADCE;
     height: 80px;
    }
    
    
    .imgUser{
      display: block;
      width: 55px ;;
      margin: auto;
      padding: 14px;
      float: right;
      margin: auto;
    }

    .div-text-user .name{
     
      margin-top: 50px;
      margin-right: 50px;
      padding-top: 22px;
      font-family: 'Calibri';
      font-style: normal;
      font-weight: 700;
      font-size: 18px;
      line-height: 22px;
      color: #4F4F4F;
    }
    .name-user{
      font-family: 'Calibri';
      font-style: normal;
      font-weight: 700;
      font-size: 18px;
      line-height: 22px;
      
      color: #606060;
    }
    .div-img-user{
      float: right;
      width: 15%;
    }

    .div-text-user{
      float: right;
      width: auto;
      margin-top: 22px;
     
    }
    .text-user{
      font-family: 'Calibri';
      font-style: normal;
      font-weight: 700;
      font-size: 18px;
      line-height: 22px;
      float: right;
    }
    

    .text-body{
      /*position: absolute;*/
      margin-top: 30px;
      margin-left: auto;
      margin-right: auto;
      width: 475px;
      height: auto;
      left: auto;
      top: 655px;

      font-family: 'Calibri';
      font-style: normal;
      font-weight: 400;
      font-size: 18px;
      line-height: 22px;
      text-align: justify;
      color: #606060;

    }
    .div-img-logo{
      float:left;
      width: 20%; 
    }
    .content-user{
      float:left;
      width: 80%;"
    }
    .hr{
      border-bottom: 3px solid #0FADCE;
    }

    @media (max-width: 575px) { 
      .content{
        width: auto;
        height: auto;
        margin: auto;
      }
     
      .imagenIcon{
        width: 50px;
        margin-top: 22px;
      }
      
      .div-text-user{
        margin-top: 8px;
      }
      .div-img-user{
        width: 20%;
      }
      .imgUser{
        width:40px ;
        padding: 0px;
      }
      .text-body{
        width: auto;
        font-size: 0.8em ;
        margin-top: 8px;
        margin-right: auto;
        margin-left: auto;
        padding: 3px;
      }
      .div-text-user .name{
        font-size: 0.8em ;
        line-height: 22px;
        
      }
      .content-user{
        padding: 9px;
      }
      .div-img-logo{
        height: 50px;
        margin: auto;
      }
      .name-user{
         font-size: 0.9em ;
      }
      .nav{
    
        height: 70px;
      }
    }
  </style>
  </head>
  <body>
    
      <div class="content">
        
        <div class="nav"> 
            <div  class="div-img-logo"> 
              <img src="https://option2health.com/img/logo2.svg" class="imagenIcon" >
            </div>
            <div  class="content-user"> 
              
              <!-- <div class="div-img-user">
                 <img src="https://option2health.com/img/user.png" class="imgUser">
              </div> -->
              <div class="div-text-user">
                <span class="name"> Nuevo contacto</span>
              </div>
              
            </div>    
        </div>

        
        <div class="text-body">
          <!-- <p class="name-user"> hola, @if(isset($array)) {{$array['user']}} @endif</p> -->
         <!--  <p>
              Hemos recibido una solicitud para restablecer la contraseña de tu cuenta de <b>O2h</b>.
          </p> -->
          <!-- <p><b> @if(isset($array)) <h3> {{$array['code']}}</h3> @endif</b></p>
          <p>Introduce este código para restablecerla.</p>

          <p style="margin-top:30px;">
            <small>Gracias por ayudarnos a mantener la seguridad de tu cuenta.
              Atentamente el equipo de Option2health.</small>
          </p> -->
        </div>
       <!--  <div class="hr"></div> -->
        <div class="text-body">
          <p ><small><b>Nombres </b>:</small> <br> <small style="color: #606060;">{{$array['name']}}</small></p>
          <p> <small><b>Email</b>:</small> <br> <small style="color: #606060;">{{$array['email']}}</small></p>
          <p> <small><b>Número Telefonico</b>:</small> <br> <small style="color: #606060;">{{$array['telefono']}}</small></p>
          <p> <small><b>Fecha</b>:</small> <br> <small style="color: #606060;">{{date('Y-m-d')}}</small></p>
        
          
        </div>
      </div>
   

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>