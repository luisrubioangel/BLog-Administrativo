 <!-- Formulacio Agmin para el crud de blog -->

 <div class="container">
  <div id="errormessage">
        <?php
          if (boolval($errores)):?>
          <?php
          foreach($errores as $error):?>
          <h3 class="errores medio"><?php echo $error?></h3>
           <?php endforeach;?>
          <?php endif;?>
   </div>
        <div class="form-admin">
        
          <form action="" method="post" role="form" class="contactForm">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Tu Email" data-rule="email" data-msg="Ingresa un Correo Valido" />
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Tu Password" data-rule="Password" data-msg="Ingresa tu Password" />
            </div>
            <div class="text-center"><button type="submit">Entrar</button></div>
          </form>
        </div>
      </div>