<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login & Register</title>
  <link rel="stylesheet" href="{{asset('register/css/login.css')}}" />
</head>
<body>

  <div class="container">
    <h2 id="form-title">Login</h2>
    <form id="auth-form" method="POST" action="{{route('login')}}">
        @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
      </div>
      <button type="submit">Submit</button>
    </form>
    <div class="toggle">
      <p id="toggle-msg">Don't have an account? <a href="{{route('register')}}" id="toggle-link">Register</a></p>
    </div>
  </div>

  {{-- <script src="{{asset('register/js/login.js')}}"></script> --}}
</body>
</html>
