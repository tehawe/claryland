<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Claryland - {{ $title }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <style>
            body {
                background: rgb(255, 125, 200);
            }

            #login-page {
                background: rgba(255, 200, 225, 0.75);
                width: 750px;
                margin: 5rem auto;
                padding: 0.75rem 1rem;
            }

            #login-form {
                margin-right: 1rem;
            }
        </style>
    </head>

    <body>
        <div class="container-fluid justify-content-center rounded" id="login-page">
            <div class="row row-cols-2 justify-content-center mt-5" id="wrapper">
                <div class="col">
                    <img src="img/claryland-icon.png" alt="ClaryLand Icon" width="100%" />
                </div>
                <div class="col">
                    @if (session()->has('loginError'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('loginError') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <img src="img/claryland-text.png" alt="ClaryLand Text" width="100%" />
                    <form action="login" method="post" id="login-form">
                        @csrf
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            <label for="username">Username</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            <label for="password">Password</label>
                        </div>

                        <button type="submit" class="form-control btn btn-primary my-3 border-3 border-white">Login</button>
                    </form>
                    <a href="#" class="btn text-light">forgot password ?</a>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>

</html>
