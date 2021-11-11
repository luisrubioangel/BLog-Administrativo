<!doctype html>
<html class="no-js" lang="ES">

<head>
  <meta charset="utf-8">
  <title>FOURID| Tech Lab</title>
  <link rel="shortcut icon" href="build/img/isologo forid_Mesa de trabajo 1.png">
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta property="og:title" content="">
  <meta property="og:type" content="">
  <meta property="og:url" content="">
  <meta property="og:image" content="">

  <link rel="manifest" href="site.webmanifest">
  
  <!-- Place favicon.ico in the root directory -->
  <link href="build/css/all.min.css" rel="stylesheet">
  <link href="build/css/fontawesome.min.css" rel="stylesheet">


  <meta name="theme-color" content="#fafafa">
  <!-- Facebook Opengraph integration: https://developers.facebook.com/docs/sharing/opengraph -->
  <meta property="og:title" content="">
  <meta property="og:image" content="">
  <meta property="og:url" content="">
  <meta property="og:site_name" content="">
  <meta property="og:description" content="">

  <!-- Twitter Cards integration: https://dev.twitter.com/cards/  -->
  <meta name="twitter:card" content="summary">
  <meta name="twitter:site" content="">
  <meta name="twitter:title" content="">
  <meta name="twitter:description" content="">
  <meta name="twitter:image" content="">

  <!-- Place your favicon.ico and apple-touch-icon.png in the template root directory -->
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800" rel="stylesheet">


  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="lib/animate-css/animate.min.css" rel="stylesheet">
  <!-- libreria de quilljs -->
  <link href="lib/quill/quill.core.css" rel="stylesheet">
  <link href="lib/quill/quill.snow.css" rel="stylesheet">
  <link href="lib/quill/quill.bubble.css" rel="stylesheet">
  

  <!-- Main Stylesheet File -->
  <link href="build/css/app.css" rel="stylesheet">
</head>
<body class="i">
 
<button type="button" id="mobile-nav-toggle"><i id="icon-menu" class="fa fa-bars"></i></button>
  <div id=""></div>
    <?php if($inicio) :?>
 
  <!--==========================
  Hero Section
  ============================-->
  <section id="hero">
    <div class="hero-container">
      <div class="wow fadeIn">
        <div class="hero-logo">
          <a href="/"><img class="" src="build/img/logo.png" alt="Fourid"></a> 
        </div>
        

        <h1>BIENVENIDOS</h1>
        <h2><span class="rotating">Investigación , Innovación , Inteligencia , Ingeniería </span>y Desarrollo</h2>
        <div class="actions">
          
          <a href="#about" class="btn-get-started">Empecemos</a>
          <a href="#services" class="btn-services">Nuestros Servicios</a>
        </div>
      </div>
    </div>
  </section>
    <?php endif; ?>
    <!--==========================
  Sección de encabezado
  ============================-->
  <header id="header">
  
    <div class="container-header">
      <div id="logo" class="pull-left">
        <a href="/"><img class="logo_navegado" src="build/img/logo.png" alt="" title="" /></img></a>
        <!-- Descomenta abajo si prefieres usar una imagen de texto -->
        <!--<h1><a href="#hero">Encabezado 1</a></h1>-->
      </div>

      <nav id="nav-menu-container">
        <ul class="nav-menu">
          <li class="menu-active"><a href="/#hero">Inicio</a></li>
          <?php if (!$auth):?>
          <li><a href="/#about">Nosotros</a></li>
          <?php endif?>
          <li class="menu-has-children "><a href="#nav-menu-container">Marcas<i class="fa fa-angle-down"></i></i></a>
              <ul id="nemuhijo">
                <li class="menu-desplegado" role="#"><a href="/#">BID BioTech</a></li>
                <li class="menu-desplegado"><a href="/#">Soporte 3D</a>
              </ul>
          </li>
          
          <?php if (!$auth):?>
          <li><a href="/#team">Equipo</a></li>
          <?php endif?>
          <li><a href="/#blogs">Blog</a></li>
          <?php if (!$auth):?>
          <li><a href="/#contact">Contactanos</a></li>
          <?php endif?>

          <?php
          //debuguear($auth);
          if ($auth):
          ?>
           <!-- <li><a href="/autoresRegister">Registrar-Autores</a></li> -->
          <li><a href="/registrar">Registrar-Autor</a></li>
          <li><a href="/logout">Cerrar Sesión</a></li>
         
          
          <?php 
          endif;  
          ?>

        </ul>
      </nav>
      <!-- #nav-menu-container -->
    </div>
  </header>
  <a href="#">
  <img id="icono-whatsapp" class="imagen-whatsapp" src="build/img/whatsapp.png" alt="whatsapp">
  </a>
  
  <!-- #header -->
  <?php
    echo $contenido;
?>

<!--==========================
  Footer
============================-->
<footer id="footer">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="copyright">
            &copy; Copyright <strong>Fourid tech Lab</strong>. Todos los derechos Reservados
          </div>
          <div class="credits">  
        </div>
      </div>
    </div>
  </footer>
    
  <!-- #footer -->
  <!-- Add your site or application content here -->

  <!--<script src="lib/jquery/jquery.min.js"></script>
   <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>
  <script src="lib/morphext/morphext.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/stickyjs/sticky.js"></script>
  <script src="lib/easing/easing.js"></script> -->
  <script src="lib/quill/quill.core.js"></script>
  <script src="lib/quill/quill.js"></script>
  <script src="lib/quill/quill.min.js" ></script>
  <script src="build/js/bundle.min.js" ></script>
  
 

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
</body>

</html>
