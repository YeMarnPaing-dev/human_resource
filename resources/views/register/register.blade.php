<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Register</title>
  <link rel="stylesheet" href="{{asset('register/css/register.css')}}" />

</head>
<body>

  <div class="container">
    <h2>Register</h2>
    <form id="register-form" method="POST" action="{{url('register')}}">
        @csrf
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" required />
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" required />
      </div>
      <div class="form-group">
        <label for="confirm-password">Confirm Password</label>
        <input type="password" name="password_confirmation" id="confirm-password" required />
      </div>
      <button type="submit">Register</button>
    </form>
  </div>

  {{--
  <script src="{{asset('register/js/register.js')}}"></script> --}}

</body>
</html>
