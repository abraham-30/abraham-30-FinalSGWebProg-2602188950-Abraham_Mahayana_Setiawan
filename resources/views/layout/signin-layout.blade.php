<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="" href="assets/images/logo/ConnectFriend-logo1.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"></link>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/assets/css/main-style.css">
    <link rel="stylesheet" href="/assets/css/signin-style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>ConnectFriend</title>
</head>
<body>
    <main style="min-height: 100vh">
        <div class="container w-100 pb-5">
            <div class="col-6 d-flex mx-auto justify-content-center py-5">
                <img src="/assets/images/logo/ConnectFriend-logo3.png" alt="" class="img-fluid" width="350">
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="text-center my-3">
                        @yield('content-title')
                    </h3>
                    @yield('content')
                </div>
              </div>
        </div>
    </main>
</body>
</html>