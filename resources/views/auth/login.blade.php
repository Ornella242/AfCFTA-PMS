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
  <body class="light ">
        <canvas id="backgroundCanvas" style="position: fixed; top: 0; left: 0; z-index: -1;"></canvas>

    <div class="wrapper vh-100">
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
      <div class="row align-items-center h-100">
        <form method="POST" action="{{ route('login') }}" class="col-lg-3 col-md-4 col-10 mx-auto text-center">
          @csrf
          <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="#">
              <img src="{{ asset('images/logo.png') }}" alt="Logo" class="navbar-brand-img brand-md">
          </a>
          <h1 class="h3 mb-3 text-green">Sign in</h1>

          <div class="form-group">
              <input type="email" name="email" id="inputEmail" class="form-control form-control-lg" placeholder="Email address" required autofocus>
          </div>

          <div class="form-group">
              <input type="password" name="password" id="inputPassword" class="form-control form-control-lg" placeholder="Password" required>
          </div>

          <div class="checkbox mb-3">
              <label>
                  <input type="checkbox" name="remember"> Stay logged in
              </label>
          </div>

          <button class="btn btn-lg bg-green text-white btn-block" type="submit">
              Let me in
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
  const canvas = document.getElementById('backgroundCanvas');
  const ctx = canvas.getContext('2d');
  const africa = new Image();
  africa.src = 'images/logo.png'; // remplace par ton image

  let shapes = [];

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
  }

  window.addEventListener('resize', resizeCanvas);
  resizeCanvas();

  function createShapes(count) {
    shapes = [];
    for (let i = 0; i < count; i++) {
      shapes.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        dx: (Math.random() - 0.5) * 0.4,
        dy: (Math.random() - 0.5) * 0.4,
        size: 30 + Math.random() * 20,
        opacity: 0.1 + Math.random() * 0.2
      });
    }
  }

  function animate() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    for (let shape of shapes) {
      ctx.globalAlpha = shape.opacity;
      ctx.drawImage(africa, shape.x, shape.y, shape.size, shape.size);
      ctx.globalAlpha = 1;

      shape.x += shape.dx;
      shape.y += shape.dy;

      if (shape.x < 0 || shape.x + shape.size > canvas.width) shape.dx *= -1;
      if (shape.y < 0 || shape.y + shape.size > canvas.height) shape.dy *= -1;
    }
    requestAnimationFrame(animate);
  }

  africa.onload = () => {
    createShapes(20); // nombre de cartes animées
    animate();
  };
</script>
  </body>
</html>
</body>
</html>