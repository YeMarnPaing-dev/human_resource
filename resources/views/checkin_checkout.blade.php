<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>CheckIn-CheckOut</title>

    <!-- Bootstrap CSS (if needed) -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Pincode CSS -->
    <link rel="stylesheet" href="{{ asset('register/css/pincode-input.css') }}">

    <style>
        body {
            padding: 40px;
            background-color: #f7f7f7;
        }

        .card {
            max-width: 400px;
            margin: auto;
            padding: 20px;
        }
    </style>
</head>

<body>

    <div class="d-flex justify-content-center">
        <div class="card shadow">
            <div class="card-body">

                <div class="text-center mb-3">
                    <img src="{{ asset('logo/HR.png') }}" alt="Logo" style="width: 100px; height: auto;">
                </div>

                <h4 class="mb-4 text-center">Enter PIN Code</h4>

                <div class="form-group">
                    <input type="text" name="mycode" id="pincode-input1" class="form-control">
                </div>

            </div>
        </div>
    </div>

    <!-- jQuery (Required for plugin) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Bootstrap Pincode JS -->
    <script src="{{ asset('register/js/bootstrap-pincode-input.js') }}"></script>

    <script>
        $(document).ready(function () {
    // Add CSRF token to all AJAX requests
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $('#pincode-input1').pincodeInput({
      inputs: 6,
      complete: function (value, e, errorElement) {
        console.log("Code entered: " + value);

        $.ajax({
          url: '/checkin',
          type: 'POST',
          data: { pin_code: value },
          success: function (res) {
            Swal.fire({
              title: "Check-In Successful!",
              text: res.message || "You have been checked in.",
              icon: "success"
            });
          },
          error: function (xhr) {
            Swal.fire({
              title: "Check-In Failed!",
              text: "Something went wrong.",
              icon: "error"
            });
          }

        });


      }



    });
  });
    </script>

</body>

</html>
