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
  </head>
  <body class="light">
        <canvas class="background-canvas"></canvas>
        {{-- <canvas id="backgroundCanvas" style="position: fixed; top: 0; left: 0; z-index: -1;"></canvas> --}}

    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
          <form method="POST" action="{{ route('register.store') }}" class="col-lg-6 col-md-8 col-10 mx-auto">
            @csrf
            <div class="mx-auto text-center my-4">
              <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand-img brand-md">
              </a>
              <h2 class="my-3 text-gold">Registration <span class="text-maroon">Form</span></h2>
            </div>
            <div class="form-group">
              <label for="inputEmail4">Email</label>
              <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="firstname">Firstname</label>
                <input type="text" id="firstname" name="firstname" class="form-control">
              </div>
              <div class="form-group col-md-6">
                <label for="lastname">Lastname</label>
                <input type="text" id="lastname" name="lastname" class="form-control">
              </div>
            </div>
            <div class="form-row">
                <label for="unit">Unit</label>
                  <select class="form-control" id="unit" name="unit_id">
                        @foreach($units as $unit)
                          <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                  </select>  
            </div>
            <hr class="my-4">
            <div class="row mb-4">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="inputPassword5">New Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword5">
                </div>
                <div class="form-group">
                  <label for="inputPassword6">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="inputPassword6">
                </div>
              </div>
              <div class="col-md-6">
                <p class="mb-2">Password requirements</p>
                <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
                <ul class="small text-muted pl-4 mb-0">
                  <li> Minimum 8 character </li>
                  <li>At least one special character</li>
                  <li>At least one number</li>
                  <li>Can’t be the same as a previous password </li>
                </ul>
              </div>
            </div>
            <button class="btn btn-lg bg-green btn-block text-white" type="submit">
              Sign up
            </button>
            <p class="mt-5 mb-3 text-muted text-center">© <span class="text-maroon">AHRMD 2025</span></p>
          </form>
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
      // Canvas animated background
      const canvas = document.querySelector(".background-canvas");
      const ctx = canvas.getContext("2d");
      let width = canvas.width = window.innerWidth;
      let height = canvas.height = window.innerHeight;

      const particles = Array.from({ length: 60 }, () => ({
        x: Math.random() * width,
        y: Math.random() * height,
        radius: Math.random() * 2 + 1,
        dx: Math.random() * 0.5 - 0.25,
        dy: Math.random() * 0.5 - 0.25
      }));

      function animate() {
        ctx.clearRect(0, 0, width, height);
        particles.forEach(p => {
          p.x += p.dx;
          p.y += p.dy;

          if (p.x < 0 || p.x > width) p.dx *= -1;
          if (p.y < 0 || p.y > height) p.dy *= -1;

          ctx.beginPath();
          ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
          ctx.fillStyle = 'rgba(128,5,69,0.3)';
          ctx.fill();
        });
        requestAnimationFrame(animate);
      }
      animate();
      window.addEventListener('resize', () => {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
      });
    </script>
<canvas id="backgroundCanvas" style="position: fixed; top: 0; left: 0; z-index: -1;"></canvas>


  </body>
</html>
</body>
</html>