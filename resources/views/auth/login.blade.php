<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="/bootstrap/css/bootstrap.css" rel="stylesheet">
</head>
<body>
    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
              <div class="card rounded-3 text-black">
                <div class="row g-0">
                  <div class="col-lg-6">
                    <div class="card-body p-md-5 mx-md-4">
                      <div class="text-center">
                        <h4 class="mt-1 mb-5 pb-1">My Cart</h4>
                      </div>
                      {{-- Session flash --}}
                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
      
                      <form action="{{route('post_login')}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" value="*****" name="password">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn" style="background-color: seagreen; color: white">Submit</button>
                        </div>
                      </form>
                      <div class="text-center pt-4">
                        <p>Don't have an account? <a href="/auth/register">Register here</a></p>

                      </div>
                    </div>
                  </div>
                  <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                    <div class="py-5 p-md-5 mx-md-4">
                      <img src="/img/cart.jpg" height="450px" width="400px" alt="cart.png" class="img-fluid">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
</body>
<script src="/bootstrap/js/bootstrap.js"></script>
<style>
    .gradient-custom-2 {
        /* fallback for old browsers */
        background: darkgreen;

        /* Chrome 10-25, Safari 5.1-6 */
        /* background: -webkit-linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593); */

        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        /* background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593); */
    }

    @media (min-width: 768px) {
        .gradient-form {
            height: 100vh !important;
        }
    }
    @media (min-width: 769px) {
        .gradient-custom-2 {
            border-top-right-radius: .3rem;
            border-bottom-right-radius: .3rem;
        }
    }

    .img-fluid {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
</html>