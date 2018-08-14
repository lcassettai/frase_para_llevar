<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="small-box bg-aqua">
      <div class="inner">
        <span class="info-box-number"><h3><?php echo $cant_usuarios; ?></h3></span>
        <p>Usuarios</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
    </div>
    <!-- /.info-box -->
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
   <div class="small-box bg-green">
      <div class="inner">
        <span class="info-box-number"><h3>0</h3></span>
        <p>Frases</p>
      </div>
      <div class="icon">
        <i class="glyphicon glyphicon-education"></i>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
     <div class="small-box bg-yellow">
      <div class="inner">
        <span class="info-box-number"><h3>0</h3></span>
        <p>Autores</p>
      </div>
      <div class="icon">
        <i class="glyphicon glyphicon-user"></i>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="small-box bg-red">
      <div class="inner">
        <span class="info-box-number">
          <h3><?php echo $cant_categorias;?></h3>
        </span>
        <p>Categorias</p>
      </div>
      <div class="icon">
        <i class="glyphicon glyphicon-list"></i>
      </div>
    </div>
  </div>
</div>
