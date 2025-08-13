<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Login Page
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="/temp/paper-dashboard-master/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/temp/paper-dashboard-master/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="/temp/paper-dashboard-master/assets/demo/demo.css" rel="stylesheet" />
</head>

<body style="background:#625c6a;">
        
        <div class="p-4 d-flex justify-content-center">
            
            <div class="content">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card card-user">
                            <div class="image" style="height: 300px;">
                                <img src="/img/login.png" alt="..." >
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <h3 class="text-center">Login to My Resto</h3>
                                    @if (session()->has('loginError'))
                                
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('loginError') }}
                                    </div>
                                    @endif
                                
                                </div>
                                <form action="{{ route('authenticate') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="username">Username</label>
                                                <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" placeholder="username" required>
                                                @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" required>
                                                @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                    </div>
                                  
                                    <div class="row">
                                        <div class="update ml-auto mr-auto">
                                            <button type="submit" class="btn btn-primary btn-round">Login</button>
                                            <a href="/" class="btn btn-secondary btn-round">Back</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                          
                        </div>
                        
                    </div>
                    
                </div>
            </div>
         
        </div>
    <!--   Core JS Files   -->
    <script src="/temp/paper-dashboard-master/assets/js/core/jquery.min.js"></script>
    <script src="/temp/paper-dashboard-master/assets/js/core/popper.min.js"></script>
    <script src="/temp/paper-dashboard-master/assets/js/core/bootstrap.min.js"></script>
   
</body>

</html>