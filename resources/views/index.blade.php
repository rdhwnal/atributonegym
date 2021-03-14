<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atribut One Gym | Fitness Terbaik di Gunung Putri</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        
    </style>
</head>
<body>
    
    <div class="container">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
    
            <div class="col-4">
                @if($msg = Session::get('error_owner'))
                    <div class="py-2">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Ooopppsss!</strong> {{ $msg }}
                            <button class="close" type="button" data-dismiss="alert" aria-labelledby="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="card text-center">
                    <div class="card-header bg-success text-white">
                        <h2>Login Owner</h2>
                    </div>
                    <form action="{{ route('owner.postlogin') }}" method="post">
                        @csrf
                
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-success">Login</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-4">
                @if($msg = Session::get('error_admin'))
                    <div class="py-2">
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Ooopppsss!</strong> {{ $msg }}
                            <button class="close" type="button" data-dismiss="alert" aria-labelledby="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="card text-center">
                    <div class="card-header bg-primary text-white">
                        <h2>Login Admin</h2>
                    </div>
                    <form action="{{ route('admin.postlogin') }}" method="post">
                        @csrf
                
                        <div class="card-body">
                            <div class="form-group">
                                <label for="email">E-Mail</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>