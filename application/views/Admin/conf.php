

 <style>
.kv-avatar .file-preview-frame,.kv-avatar .file-preview-frame:hover {
    margin: 0;
    padding: 0;
    border: none;
    box-shadow: none;
    text-align: center;
}
.kv-avatar .file-input {
    display: table-cell;
    max-width: 220px;
}
</style>
 <div class="content-wrapper">
 	<section class="content-header">
          <h1>
           Cuenta Addles
            <small> | Configuracion </small>
          </h1>
    </section>
	<section class="content" style="width: 80%; margin:0 auto;">
		<div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Configura tu cuenta.</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <form class="user-update" action="<?=base_url()?>admin/update_basic_data" method="post">
                    <div class="row">
                      <div class="col-md-8">
                        <label>Usuario: </label>
                        <input type="text" name="nusuario" id="nusuario" class="form-control" placeholder="Ingresa un usuario" value="<?=base64_decode($result->nusuario)?>">
                        <label>Nombre: </label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Ingresa tu nombre" value="<?=$result->nombre?>">
                        <label>Apellido: </label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="Ingresa tu apellido" value="<?=$result->apellido?>">
                        <label>Correo: </label>
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="Ingresa tu correo" value="<?=$result->correo?>">
                      </div>
                      <div class="col-md-4">
                        <div id="kv-avatar-errors-1" class="center-block" style="width:800px;display:none"></div>
                        <div class="kv-avatar center-block" >
                            <input id="avatar-1" name="avatar" type="file" class="file-loading">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <input type="button" value="Actualizar" id="btn_update" class="btn btn-primary">
                      </div>
                    </div>
                    <input type="hidden" name="bg" value="<?=$result->avatar?>">
                  </form>
                  <br>
                  <div class="row">
                    <div class="col-md-8" id="pass-content">
                      <label>Contraseña:</label>
                      <input type="password" value="password" class="form-control" disabled="disabled"><br>
                      <butto class="btn btn-warning" id="change_pass">Cambiar contraseña</button>
                    </div>
                  </div>
                </div>
    </div>
  </section>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="mymodal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cambiar Contraseña</h4>
      </div>
      <div class="modal-body">

      <div class="row">
        <div class="col-md-12" id="alerta">
          
        </div>
      </div>

        <form action="<?=base_url()?>admin/update_password" id="update_pass">
        <div class="row">
          <div class="col-md-12">
            <label>Contraseña Actual:</label>
            <input type="password" class="form-control" name="pw-now" placeholder="Contraseña actual" required="required" id="pw-now">
          </div> 
          <div class="col-md-12">
            <label>Nueva contraseña:</label>
            <input type="password" class="form-control" name="pw-new" placeholder="Contraseña nueva" required="required" id="pw-new">
          </div> 
          <div class="col-md-12">
            <label>Repite contraseña:</label>
            <input type="password" class="form-control" name="pw-renew" placeholder="Repite contraseña" required="required" id="pw-renew">
          </div> 
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" id="save_pass" class="btn btn-primary">Guardar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->