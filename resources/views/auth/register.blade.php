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
    .bg-register-curve {
        background: linear-gradient(to top left, #70CA89, #70CA89);
        clip-path: polygon(20% 0%, 100% 0%, 100% 100%, 0% 100%);
    }

    @media (max-width: 768px) {
        .bg-register-curve {
            clip-path: none;
        }
    }

   .form-control, .form-select {
        background-color: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 12px;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.08);
        transition: all 0.2s ease-in-out;
    }

    .form-control:focus, .form-select:focus {
        box-shadow: 0 4px 8px rgba(112, 202, 137, 0.4);
        border-color: #70CA89;
        outline: none;
    }
</style>

  </head>
  <body class="light">
    
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
    <div class="row w-100" style="max-width: 1100px; box-shadow: 0 0 25px rgba(0,0,0,0.1); border-radius: 15px; overflow: hidden;">
        <!-- Left: Form -->
        <div class="col-12 col-md-7 bg-white pt-3">
            <form method="POST" action="{{ route('register.store') }}">
                @csrf
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="max-height: 60px;">
                    <h3 class="mt-2 text-maroon">Registration Form</h3>
                </div>

                <div class="form-group">
                    <label>Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Firstname <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Lastname <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" class="form-control" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Unit <span class="text-danger">*</span></label>
                    <select name="unit_id" class="form-control" required>
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>
                </div>

                <button type="submit" class="btn bg-maroon text-white btn-block mt-4">
                    Sign up
                </button>

                <p class="mt-4 text-center text-muted">© AHRMD 2025</p>
            </form>
        </div>

        <!-- Right: Info Panel -->
        <div class="col-12 col-md-5 d-flex flex-column justify-content-center align-items-center p-4 curve-right text-center bg-gold">
            <h2 class="text-white">Welcome dear colleague!</h2>
            <p  class="text-white">Already have an account? Click below to login</p>
            <a href="{{ route('login') }}" class="btn bg-maroon text-white mb-3">LOGIN</a>
            <img src="{{ asset('images/register.png') }}" alt="Illustration" class="img-fluid mt-3" style="max-height: 250px;">
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