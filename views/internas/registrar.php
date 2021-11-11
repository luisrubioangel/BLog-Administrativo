<div class="container center">
  <?php
  if (boolval($errores)):?>
    <?php
  foreach($errores as $error):?>
  <h3 class="errores medio"><?php echo $error?></h3>
  <?php endforeach;?>
  <?php endif;?>

</div>
<div class="container">
        <div class="form-admin">
        <div id="errormessage"></div>
          <form action="" method="post" role="form" class="contactForm" enctype='multipart/form-data'>
          <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Tu Nombre" data-rule="Nombre" data-msg="Ingresa Tu Nombre" />
          </div>
          <div class="form-group">
                <label for="last-name">Apellido</label>
                <input type="text" class="form-control" name="last-name" id="last-name" placeholder="Tu Apellido" data-rule="Apellido" data-msg="Ingresa Tu Apellido" />
          </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" data-rule="email" data-msg="Ingresa un Correo Valido" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Tu Password" data-rule="Password" data-msg="Ingresa tu Password" />
            </div>
            <div class="form-group">
                <label for="Re-password">Confirmar Password</label>
                <input type="password" class="form-control" name="password_r" id="Re-password" placeholder="Tu Password" data-rule="Password" data-msg="Ingresa tu Password" />
            </div>
            <div>
              <label for="form-group">Cargo</label>
              <input type="text" name="Cargo" id="cargo" data-msg="Tu cargo de la empresa" >
            </div>
            <div>
              <!-- <label for="imageFile">Foto</label><br> -->
              <input type="file" class="registar-inmgen" id="imageFile" name="imagen-photo" accept=".jpg,.png">
          
            </div>
            
            <div class="text-center"><button type="submit">Registrar</button></div>
          </form>
        </div>
      </div>