<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body class="bg-light">
    <div style="height: 100vh;">
        <div class="row h-100 mb-0">
            <div class="card w-25 my-auto mx-auto">
                <div class="card-header bg-white border-0 py-3">
                    <h1 class="text-center">Login</h1>
                </div>
                <div class="card-body">
                    <form action="../actions/User_action.php" method="post" autocomplete="off">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="" class="form-control mb-2" placeholder="USERNAME" required autofocus>
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control mb-2" placeholder="PASSWORD" required>
                        <button type="submit" class="form-control btn btn-primary">Login</button>
                    </form>
                    <p class="text-center small mt-2">Create Account <a href="../views/Register.php">Register</a></p>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>