<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register User</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-image: url('bagroundrt.jpg');
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: 'Arial', sans-serif;
            margin: 0;
            color: #333;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            animation: fadeIn 1s forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-title {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 25px;
            color: #2575fc;
            text-align: center;
        }

        .btn-primary {
            background: #2575fc;
            border: none;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-primary:hover {
            background: #6a11cb;
            transform: translateY(-2px);
        }

        .form-footer {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #2575fc;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 10px rgba(37, 117, 252, 0.3);
        }

        .form-select:focus {
            border-color: #2575fc;
            box-shadow: 0 0 10px rgba(37, 117, 252, 0.3);
        }

        .alert {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h2 class="form-title"><i class="fa fa-user-plus"></i> Register User</h2>
        <hr>
        @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif
        <form id="registerForm">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label"><i class="fa fa-envelope"></i> Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label"><i class="fa fa-user"></i> Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="Enter your name" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label"><i class="fa fa-key"></i> Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100"><i class="fa fa-user-plus"></i> Register</button>
            <div class="form-footer">
                <p>Already have an account? <a href="{{ route('login') }}">Login here!</a></p>
            </div>
        </form>

        <!-- Tambahkan alert untuk menampilkan pesan -->
        <div id="alertMessage" class="alert d-none mt-3"></div>



        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $("#registerForm").submit(function (e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = {
                _token: "{{ csrf_token() }}",
                email: $("#email").val(),
                name: $("#name").val(),
                password: $("#password").val(),
            };

            $.ajax({
                url: "{{ route('actionregister') }}",
                type: "POST",
                data: formData,
                success: function (response) {
                    if (response.success) {
                        $("#alertMessage")
                            .removeClass("d-none alert-danger")
                            .addClass("alert-success")
                            .text(response.message);
                        $("#registerForm")[0].reset(); // Reset form setelah berhasil
                    } else {
                        $("#alertMessage")
                            .removeClass("d-none alert-success")
                            .addClass("alert-danger")
                            .text(response.message);
                    }
                },
                error: function (xhr) {
                    let errorMessage = "Terjadi kesalahan!";

                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    $("#alertMessage")
                        .removeClass("d-none alert-success")
                        .addClass("alert-danger")
                        .text(errorMessage);
                }
            });
        });
    });
</script>

    </div>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
