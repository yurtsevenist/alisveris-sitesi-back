@extends('auth.master')
@section('content') 
@php
    if (isset($_COOKIE['loginemail']) && isset($_COOKIE['loginpassword'])) {
        $email = $_COOKIE['loginemail'];
        $password = $_COOKIE['loginpassword'];
        if(Auth::attempt(['email'=>$email,'password'=>$password])){
            setcookie('loginemail',$email,time()+60*60*24*365);
            setcookie('loginpassword',$password,time()+60*60*24*365);
            @endphp
            <script>
                window.location.href = "/dashboard";
            </script>
            @php
        }
        
    }
    @endphp
    <div class="card-body">
      <p class="login-box-msg">Oturum açmak için e-posta ve şifreniz ile giriş yapınız!</p>
      <form action="{{route('loginPost')}}" method="post">
        @csrf
        @include('auth.errors')
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="E-Posta Adresiniz" name="email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" placeholder="Şifreniz" name="password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Beni Hatırla
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Giriş Yap</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{url('forget')}}">Şifremi hatırlamıyorum</a>
      </p>
      <p class="mb-0">
        <a href="{{url('register')}}" class="text-center">Henüz üye değilim</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

@endsection