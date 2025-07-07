<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Human Resourse</title>
  <link rel="stylesheet" href="{{asset('register/css/login.css')}}" />
  {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css"  > --}}
</head>
<body>

  <div class="container">
    <h2 id="form-title">Login</h2>
    <form id="auth-form" method="POST" action="{{route('login')}}">
        @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="@error('email')
        is-invalid
        @enderror"  />
        @error('email')
        <div class="invalid-feedback" style="color:red">
        {{$message}}
        </div>
        @enderror
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="@error('password')
        is-invalid
        @enderror"/>
         @error('password')
        <div class="invalid-feedback" style="color:red">
        {{$message}}
        </div>
        @enderror
      </div>
      <button type="submit">Submit</button>
    </form>
    {{-- <div class="toggle">
      <p id="toggle-msg">Don't have an account? <a href="{{route('register')}}" id="toggle-link">Register</a></p>
    </div> --}}
  </div>

  {{-- <script src="{{asset('register/js/login.js')}}"></script> --}}
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q" crossorigin="anonymous"></script> --}}
</body>
</html>
