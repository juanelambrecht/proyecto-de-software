<?= $this->extend('template/home-template'); ?>
<?= $this->section('content'); ?>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    <?php if(session()->getFlashData('mensaje')){ ?> 
    Swal.fire({
  icon: 'error',
  title: 'Algo Salio Mal...',
  text: 'Usuario y/o contraseña incorrecta...',
  footer: '<a href="#registro">Todavia no se encuentra registrado?</a>'
})

<?php } ?>
    </script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  <?php if (session()->getFlashData('registerOK')) { ?>
    Swal.fire({
      icon: 'exito',
      title: 'Registrado con exito!',
      text: 'Ya puedes ingresar',
      //   footer: '<a href="#registro">Todavia no se encuentra registrado?</a>'
    })

  <?php } ?>
</script>

</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  <?php if (session()->getFlashData('registerFail')) { ?>
    Swal.fire({
      icon: 'error',
      title: 'Intente otra vez.',
      text: 'Ya existe un usuario',
      //   footer: '<a href="#registro">Todavia no se encuentra registrado?</a>'
    })

  <?php } ?>
</script>

<div class="container">
  <br><br>
  <section class="vh-100">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-9 col-lg-6 col-xl-5">
          <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-login-form/draw2.png" class="img-fluid" alt="Sample image">
        </div>
        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
          <form action="<?= base_url('usuarios/autenticate') ?>" method="POST">
            <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
              <p class="lead fw-normal mb-0 me-3">Inicia sesión con</p>
              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-facebook-f"></i>
              </button>

              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-twitter"></i>
              </button>

              <button type="button" class="btn btn-primary btn-floating mx-1">
                <i class="fab fa-linkedin-in"></i>
              </button>
            </div>

            <div class="divider d-flex align-items-center my-4">
              <p class="text-center fw-bold mx-3 mb-0">O ingrese aqui:</p>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="text" id="inputUsername" name="username" class="form-control form-control-lg" placeholder="Ingrese un usuario valido" />
              <label class="form-label" for="form3Example3">Usuario del sistema</label>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-3">
              <input type="password" id="inputPass" name="pass" class="form-control form-control-lg" placeholder="Ingrese una contraseña" />
              <label class="form-label" for="form3Example4">Contraseña</label>
            </div>

            <div class="d-flex justify-content-between align-items-center">
              <!-- Checkbox -->
              <div class="form-check mb-0">
                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                <label class="form-check-label" for="form2Example3">
                  Recuerdame
                </label>
              </div>
              <a href="#!" class="text-body">¿Olvidaste tu contraseña?</a>
            </div>

            <div class="text-center text-lg-start mt-4 pt-2">
              <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Ingresar</button>
              <p class="small fw-bold mt-2 pt-1 mb-0">No estas registrado? <a href="#!" class="link-danger">Registrarse</a></p>
            </div>

          </form>
        </div>
      </div>
    </div>

  </section>

</div>

<?= $this->endsection('content'); ?>