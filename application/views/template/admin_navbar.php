<style type="text/css">
  .op:hover{
    background-color: #E6E6E1;
    color: #0E2C47;
    font-weight: bold;
  }
  .ic{
    font-size: 25px;
  }
</style>
<?php $this->load->helper('admin_navbar'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <!--Usuario y mensajes-->
      <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
       <a href="<?= base_url('admin_home_controller/index'); ?>" title="Home"><button type="button" class="btn btn-secondary"><i class="fas fa-user-circle ic"></i>&nbsp<?= $this->session->userdata('nombre') ?></button></a>
       <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-sitemap ic"></i>&nbspMantenimiento
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <a class="dropdown-item op" href="<?= base_url('admin_usuario_controller/index'); ?>">Usuario</a>
          <a class="dropdown-item op" href="<?= base_url('admin_categoria_controller/index'); ?>">Categoria</a>
          <a class="dropdown-item op" href="<?= base_url('admin_producto_controller/index'); ?>">Producto</a>
          <a class="dropdown-item op" href="<?= base_url('admin_direccion_controller/index'); ?>">Direcciones</a>
          <a class="dropdown-item op" href="<?= base_url('admin_pedido_controller/index'); ?>">Pedido</a>
          <a class="dropdown-item op" href="<?= base_url('admin_producto_detalle_controller/index'); ?>">Detalles de producto</a>
        </div>
      </div>
      <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-user ic"></i>&nbspOpciones
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <a class="dropdown-item op" href="#" data-toggle="modal" data-target="#cambiarPass">Cambiar contraseña</a>
          <a class="dropdown-item op" href="<?= base_url('admin_navbar_controller/cerrar'); ?>">Cerrar sesión</a>
        </div>
      </div>
      <button type="button" class="btn btn-secondary"><i class="fas fa-envelope ic"></i>&nbspMensajes</button>
    </div>
  </li>
</ul>
</div>

<div style="width: 50%">
  <a title="Home" href="<?= base_url('admin_home_controller/index'); ?>"><img class="rounded mx-auto d-block" style="height:50px; margin-top: 5px; margin-bottom: 5px;" src="<?= base_url('props/images/GabyGavannaLogo.png'); ?>"></a>
</div>
</nav>

<!--Modal cambiar contraseña-->
  <div class="modal fade" id="cambiarPass" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle">Cambio de <span class="badge badge-info"> contraseña <i class="fas fa-pen-square"></i></span></h3>
          <div title="Mostrar contraseñas" id="showPassCp" data="0" style="width: 10%;float: left; justify-content: center; cursor: pointer;" class="input-group-text">
                        <i style="font-size: 25px;" class="fas fa-eye"></i></div>
        </div>
        <div class="modal-body">
          <div class="card">
            <div style="padding-bottom: 15px; padding-top: 15px">
              <form id="formCpass" method="POST" action="<?= base_url('admin_navbar_controller/change'); ?>">
                <center><table class="table">
                  <tr>
                    <td>
                      <input class="form-control" type="password" name="pass1" id="pass1" placeholder="Ingresa tu contraseña actual">
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <input class="form-control" type="password" name="pass2" id="pass2" placeholder="Confirma tu contraseña actual">
                      <!--Alerta correo-->
                      <div id="mensajeAlertaChangePass"></div>
                      <!--Alerta fin-->
                    </td>
                  </tr>
                  <tr>
                    <td><input class="form-control" type="password" name="passCp" id="passCp" placeholder="Ingresar tu nueva contraseña">
                      </td>
                    </tr>
                  </table>
                  <!--Alerta correo-->
                        <div id="mensajeAlertaPassCp"></div>
                        <!--Alerta fin-->
                </center>
              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button style="width: 50%; font-size: 20px; font-weight: bold" id="btnCpass" type="button" class="btn btn-primary">Cambiar contraseña</button>
          <button style="width: 50%; font-size: 20px; font-weight: bold" id="cerrarCp" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
  <!--Modal cambiar contraseña-->

