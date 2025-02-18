<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome USER</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{asset('resep.css')}}">
    <style>
        body {
            display: flex;
        }

        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #f8f8f8;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .sidebar a {
            display: block;
            padding: 10px;
            color: #333;
            text-decoration: none;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .sidebar a:hover {
            background-color: #e7e7e7;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .card:hover img {
            transform: scale(1.1);
        }

        .card-body {
            padding: 15px;
            text-align: center;
        }

        .card-body h5 {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-body p {
            font-size: 14px;
            color: #666;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h3>Pendataan</h3>
        <a href="{{route('home')}}"><i class="fa fa-home"></i> Home</a>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> {{Auth::user()->name}} <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
                <li><a>Role: {{Auth::user()->role}}</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="{{route('actionlogout')}}"><i class="fa fa-power-off"></i> Log Out</a></li>
            </ul>
        </div>
    </div>

    <div class="main-content">
        <h2>Tambah Siswa</h2>
        <form id="siswaForm">
            @csrf
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" class="form-control" id="nama" name="nama" required>
            </div>
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" class="form-control" id="kelas" name="kelas" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <span id="btnText">Simpan</span>
                <span id="loadingSpinner" class="spinner-border spinner-border-sm d-none"></span>
            </button>
        </form>

        <h2>Daftar Siswa</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Kelas</th>
                </tr>
            </thead>
            <tbody>
                @foreach($siswa as $s)
                <tr>
                    <td>{{ $s->id }}</td>
                    <td>{{ $s->nama }}</td>
                    <td>{{ $s->kelas }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function () {
            $("#siswaForm").submit(function (e) {
                e.preventDefault();

                let formData = {
                    _token: "{{ csrf_token() }}",
                    nama: $("#nama").val(),
                    kelas: $("#kelas").val(),
                };


                $("#btnText").text("Menyimpan...");
                $("#loadingSpinner").removeClass("d-none");
                $("#loadingSpinner").addClass("spinner-border spinner-border-sm");

                $.ajax({
                    url: "{{ route('siswa.store') }}",
                    type: "POST",
                    data: formData,
                    beforeSend: function () {

                        $("body").append('<div id="overlay" style="position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.3); display:flex; align-items:center; justify-content:center; z-index:1000;"><div class="spinner-border text-light" role="status"><span class="sr-only">Loading...</span></div></div>');
                    },
                    success: function (response) {
                        if (response.success) {

                            $("tbody").append(`
                                <tr>
                                    <td>${response.data.id}</td>
                                    <td>${response.data.nama}</td>
                                    <td>${response.data.kelas}</td>
                                </tr>
                            `);
                            $("#siswaForm")[0].reset();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function (xhr) {
                        alert("Terjadi kesalahan!");
                    },
                    complete: function () {
                        
                        $("#btnText").text("Simpan");
                        $("#loadingSpinner").addClass("d-none");
                        $("#loadingSpinner").removeClass("spinner-border spinner-border-sm");
                        $("#overlay").remove();
                    }
                });
            });
        });
    </script>


    <!-- Scripts -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</body>
</html>
