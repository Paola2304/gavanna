<style type="text/css">
  .op:hover{
    background-color: #E6E6E1;
    color: #0E2C47;
    font-weight: bold;
  }
</style>
<?php $this->load->helper('navbar'); ?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
 <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <ul class="navbar-nav mr-auto">
    <!--Usuario y mensajes-->
    <div class="btn-group " role="group" aria-label="Button group with nested dropdown">
      <a title="Inicio" href="<?= base_url('home_controller'); ?>"><button type="button" class="btn btn-secondary bg-dark"><i class="fas fa-home"></i></button></a>
      <div class="btn-group" role="group">
        <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle bg-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fab fa-gratipay"></i>&nbspCategorias
        </button>
        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
          <div id="categoriasSelect"> </div>
  
       </div>
     </div>
   </div>
 </ul>
</div>
<div style="width: 100%">
  <a href="<?= base_url('home_controller'); ?>"><img class="rounded mx-auto d-block" style="height:50px; margin-top: 5px; margin-bottom: 5px;" src="<?= base_url('props/images/GabyGavannaLogo.png'); ?>"></a>
</div>

<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
  <div class="btn-group" role="group">
    <?php if ( $this->session->userdata('nombre')) {?>
      <a href="<?= base_url('perfil_controller'); ?>"><button title="Perfil" type="button" class="btn btn-secondary  bg-dark"><b><?= $this->session->userdata('nombre'); ?></b></button></a>
    <?php }else{ ?>
      <a href="<?= base_url('perfil_controller'); ?>"><button title="Iniciar sesion" type="button" class="btn btn-secondary  bg-dark"><i class="fas fa-user"></i></button></a>
    <?php  } ?>


    <button title="Tus compras" type="button" class="btn btn-secondary  bg-dark"><i class="fas fa-shopping-bag"></i></button>
  </div>
</div>
</div>
</nav>


