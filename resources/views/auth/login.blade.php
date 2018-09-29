<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <title>Sistema Comanche</title>
    <style media="screen">
      .text-white{
        color: white;
      }
    </style>
</head>
<body>
<div class="container-fluid">
    {{-- <hr> --}}
    @if(session()->has('flash'))
        <div class="alert alert-info">{{ session('flash') }}</div>
    @endif
    <div class="row">
      <div class="col md-8 col-lg-8 col-sm-12 bg-molino">
        {{-- <img src="{{asset('img/molino_bg.jpg')}}" alt="molino_bg" style="width:100%"> --}}
      </div>
        {{-- <div class=" col md-4 col-lg-offset-4 col-lg-4 col-lg-offset-4 col-sm-12"> --}}
        <div class=" col md-4 col-lg-4 col-sm-12 " style="height:100vh;background-color:#f39c12;">

            {{-- <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">Acceso a la aplicación</h1>
                </div> --}}
                <div style="margin:30px; padding-top:10vh;">
                <h3 class="text-center text-white"><img src="{{asset('img/logo.png')}}" width="20%" alt=""> EL COMANCHE</h3>
                    <form action="{{route('login')}}" method="post">
                        {{csrf_field()}}
                        <div class="form-group {{$errors->has('name')? 'has-error':''}} text-white">
                            <label for="email" >Usuario</label>
                            <input class="form-control"
                                   type="text"
                                   name="name"
                                   placeholder="Ingresa tu usuario"
                                    onkeypress="return lettersOnly(event)" maxlength="15"
                                   value="{{old('name')}}">
                            {!! $errors->first('name','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="form-group {{$errors->has('password')? 'has-error':''}} text-white">
                            <label for="password">Contraseña</label>
                            <input class="form-control"
                                   type="password"
                                   name="password"
                                    maxlength="15"
                                   placeholder="Ingresa tu password">
                            {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                        </div>
                        <div class="checkbox text-white">
                            <label>
                                <input type="checkbox" name="remember" id="remember" value="1"> Recuérdame
                            </label>
                        </div>
                        <button class="btn btn-danger btn-block">Acceder</button>
                    </form>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>

<!-- Latest compiled and minified JavaScript -->
<script type="text/javascript">
function lettersOnly()
{
          var charCode = event.keyCode;

          if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8)

              return true;
          else
              return false;
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
