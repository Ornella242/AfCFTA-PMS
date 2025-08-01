<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>AHRMD Projects</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="css/feather.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="css/daterangepicker.css">
    <!-- App CSS -->
    <link rel="stylesheet" href="css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="css/app-dark.css" id="darkTheme" disabled>
    <style>
      .card {
          border: none;
          box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      }
      .btn-outline-light:hover {
          background-color: #ffffff;
          color: #2C7BE5;
      }

    </style>
  </head>
  <body class="light ">
    <div class="wrapper d-flex align-items-center justify-content-center vh-100" style="position: relative; overflow: hidden;">
    <!-- Bleu incurvé en arrière-plan -->
    <div style="
        position: absolute;
        top: 0;
        left: 0;
        width: 60%;
        height: 100%;
        background: #299347;
        clip-path: ellipse(100% 100% at 0% 50%);
        z-index: 0;
    "></div>
      @if(session('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif

          @if(session('error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  {{ session('error') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
          @endif
      <div class="container d-flex align-items-center justify-content-center vh-100">
          <div class="row w-100" style="max-width: 1000px; border-radius: 15px; overflow: hidden; box-shadow: 0 0 25px rgba(0,0,0,0.1);">

              <!-- Left Panel -->
              <div class="col-12 col-md-6 d-flex flex-column align-items-center justify-content-center text-white p-4" style="background: #70CA89;">
                  <h2 class="text-white text-center">Welcome back dear colleague!</h2>
                  <p class="text-center">Don't have an account yet? Click on sign up</p>
                  <a href="{{ url('/register') }}" class="btn btn-outline-light mt-1">SIGN UP</a>
                  <img src="{{ asset('images/login.png') }}" alt="Login Illustration" class="img-fluid mt-3" style="max-height: 250px;">
              </div>

              <!-- Right Panel -->
              <div class="col-12 col-md-6 bg-light p-5">
                  <div class="d-flex flex-column align-items-center justify-content-center mb-4">
                      <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mb-3" style="max-height: 60px;">
                  </div>

                  <form method="POST" action="{{ route('login') }}">
                      @csrf
                      <h3 class="mb-4 text-center">Login to your account</h3>
                      
                      <div class="form-group mb-3">
                          <input type="email" name="email" class="form-control form-control-lg" placeholder="Email" required>
                      </div>
                      <div class="form-group mb-3">
                          <input type="password" name="password" class="form-control form-control-lg" placeholder="Password" required>
                      </div>
                      <div class="form-group text-right mb-3">
                          <a href="#" class="text-muted small">Forgot password?</a>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn bg-green text-white btn-block btn-lg">LOGIN</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>


    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/simplebar.min.js"></script>
    <script src='js/daterangepicker.js'></script>
    <script src='js/jquery.stickOnScroll.js'></script>
    <script src="js/tinycolor-min.js"></script>
    <script src="js/config.js"></script>
    <script src="js/apps.js"></script>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag()
      {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      gtag('config', 'UA-56159088-1');
    </script>
 <script>
  <script>
  window.addEventListener('load', function() {
    const loader = document.getElementById('pageLoader');
    loader.classList.add('hide');

    setTimeout(() => {
      loader.style.display = 'none';
    }, 500); // match la durée de l'opacité
  });
</script>

 </script>
  </body>
</html>
</body>
</html>