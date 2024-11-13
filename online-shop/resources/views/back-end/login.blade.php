<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('back-end/assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/assets/vendors/iconfonts/ionicons/dist/css/ionicons.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('back-end/assets/vendors/css/vendor.bundle.addons.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    {{-- link icons bootstrap --}}
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') }}">
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('back-end/assets/css/shared/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('back-end/assets/images/favicon.ico') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">
                  @if (Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
                      <strong>{{ Session::get('error') }}</strong>
                      <button type="button" class="btn-close btn" data-bs-dismiss="alert" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                    </div>
                  @endif
                <form action="{{ route('auth.authenticate') }}" method="POST">
                  <h4 class="text-center">LOGIN DASHBORAD</h4>
                  @csrf
                  <div class="form-group mt-2">
                    <label class="label">Email</label>
                      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="email address">
                      @error('email')
                            <p class="text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                      <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="*********">
                      @error('password')
                            <p class="text-danger">{{ $message }}</p>
                      @enderror
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                  </div>
                  <div class="form-group d-flex justify-content-between">
                    <div class="form-check form-check-flat mt-0">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" checked> Keep me signed in </label>
                    </div>
                    <a href="#" class="text-small forgot-password text-black">Forgot Password</a>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-block g-login">
                      <img class="mr-3" src="{{ asset('back-end//assets/images/file-icons/icon-google.svg') }}" alt="">Log in with Google</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('back-end/assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('back-end/assets/vendors/js/vendor.bundle.addons.js') }}"></script>
    <!-- endinject -->
    <!-- inject:js -->
    <script src="{{ asset('back-end/assets/js/shared/off-canvas.js') }}"></script>
    <script src="{{ asset('back-end/assets/js/shared/misc.js') }}"></script>
    <!-- endinject -->
    <script src="{{ asset('back-end/assets/js/shared/jquery.cookie.js') }}" type="text/javascript"></script>
  </body>
</html>