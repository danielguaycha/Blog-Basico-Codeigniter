 <?php
        if($this->input->get('edit')==null || $this->input->get('edit') ==""){
 ?>
  <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper" style="height: 90vh;">
        <!-- Main content -->
        <section class="content">
  
        <form id="frm_save_eval" method="post" action="<?=base_url()?>admin/save_eval" enctype="multipart/form-data" >
			<input type="hidden" value="1" name="option" required>
			<div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Crear Evaluación</h3>
              </div>
             <div class="box-body"> 
              	<label for="">Escoja la opción a evaluar</label>
              	<select name="id_tem" id="select2" class="form-control">
              		<option value="">Seleccione...</option>
              		<?php foreach ($consulta->result() as $fila): ?>
              			<option value="<?=$fila->id_pos?>"><?=$fila->tit_pos?></option>
              		<?php endforeach ?>
              	</select><br><br>
				<label for="">Titulo para mostrar</label>
				<input type="text" class="form-control" name="eva_tit" id="eva_tit" required>
				<label for="">Indicaciones</label>
				<input type="text" class="form-control" name="eva_des" id="eva_des" required>
				<div class="row">
					<div class="col-md-2">
						<label for="">Tiempo</label>
						<div class="input-group clockpicker">
						    <input type="text" class="form-control" value="00:00" name="eva_tim" id="eva_tim" required>
						    <span class="input-group-addon">
						        <i class="fa fa-clock-o"></i>
						    </span>
						</div>
					</div>

					<div class="col-md-3">
						<label for="">Contraseña</label>
						<input type="password" class="form-control" name="eva_pwr" id="eva_pwr" required>
					</div>
					<div class="col-md-3">
						<label for="">Repite Contraseña</label>
						<input type="password" class="form-control" id="eva_pw2" name="eva_pwr2" required>
					</div>
					<div class="col-md-2">
						<label for="">Promedio</label>
						<input type="number" step="0.01" class="form-control" value="100" name="eva_tot" id="eva_tot" required>
					</div>
					<div class="col-md-2">
						<label for="">Numero intentos Pregunta</label>
						<input type="number" name="eva_num_int" id="eva_num_int" value="0" class="form-control" required>
					</div>
				</div>
				
						<!---
				<hr>
				<div class="row">
					
					<div class="col-md-12">
						<h5>Preguntas</h5> <a class="btn btn-primary insert_qt"><i class="fa fa-plus"> </i> Insertar</a><br>
						    <div class="row">
							        <div class="col-md-12 qt-add">
							     
							        </div>
    						</div>

				    <div class="modal_cont_qs">
				        <section class="modal_questions">
				            <article class="modal_cont">
				                <div class="modal-header">
				                    <h3>Agregar Pregunta</h3>
				                    <a href="" class="close-modal crr-modal"><i class="fa fa-close"></i></a>
				                </div>
				                <div class="modal-body">
				                    <form action="" id="preguntas">
				                        <span for="">Tipo de Pregunta</span>
				                        <select name="pre_tip" id="pre_tip" class="form-control" disabled>
				                            <option value="1">Una sola opcion</option>
				                        </select>
				                        <span>Enunciado de la pregunta</span>
				                        <textarea name="pre_def" id="pre_def" cols="30" rows="5" class="form-control"></textarea>
				                        <h5>Opciones de respuesta</h5>
				                        <div class="panel panel-default">
				                            <table class="table table-hover">
				                                <thead>
				                                    <tr>
				                                        <th>Opción</th>
				                                        <th>
				                                            <button type="button" class="btn btn-default pull-right" id="add_lit"><i class="fa fa-plus"></i> Añadir</button>
				                                        </th>
				                                    </tr>
				                                </thead>
				                            </table>
				                            <div class="panel-footer" id="opciones">
				                                <div class="input-group ad_">
				                                    <span class="input-group-btn">
				                                        <button class="lit_vit form-control" disabled>a</button>
				                                    </span>
				                                    <input class="form-control lit" placeholder="Introduce una nueva opción ">
				                                    <span class="input-group-btn">
				                                        <button type="button" class="btn btn-default del_lit"><i class="fa fa-minus"></i> Elimimar</button>
				                                    </span>
				                                </div>


				                            </div>

				                        </div>
				                        <hr>
				                        <span>Respuesta Correcta:</span>
				                        <div class="input-group">
				                            <span class="input-group-btn">
				                                <button disabled class="btn">Respuesta</button>
				                            </span>
				                            <select name="pre_rsp" id="pre_rsp" class="form-control">
				                                <option value="a">a</option>

				                            </select>
				                            <span class="input-group-btn">
				                                    <button type="button" class="btn btn-success" id="confirm-cuestion">Confirmar</button>
				                                    <button  type="button" class="btn btn-danger crr-modal">Cancelar</button>
				                            </span>
				                        </div>

				                    </form>

				                </div>
				            </article>
				        </section>
				    </div>
				    <div class="modal-backdrop  in fv-modal-stack" style="z-index: 1049;"></div>

					</div>
					
				</div>
			-->
              </div>
              <div class="box-footer">
              	<button class="btn btn-primary" role="button" id="btn_save_eval">Guardar</button>
              	<a href="<?=base_url()?>admin/updateval" class="btn btn-danger" role="button" id="bnt_cancel_eval">Cancelar</a>
              </div>
              </div>
      	</form>
        </section>

       </div>

<?php }else{ ?>
	<div class="content-wrapper" style="height: 90vh;">
        <!-- Main content -->
        <section class="content">
        <form id="frm_save_eval" method="post" action="<?=base_url()?>admin/save_eval" enctype="multipart/form-data" >
			<input type="hidden" value="2" name="option" required>
			<input type="hidden" name="id_eva" value="<?=$data->id_eva?>">
			<div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Actualizar Evaluación</h3>
              </div>
             <div class="box-body"> 
              	<label for="">Escoja la opción a evaluar</label>
              	<select name="id_tem" id="select2" class="form-control">
              		<option value="">Seleccione...</option>
              		<?php foreach ($consulta->result() as $fila): ?>
              			<option value="<?=$fila->id_pos?>"><?=$fila->tit_pos?></option>
              		<?php endforeach ?>
              	</select><br><br>
				<label for="">Titulo para mostrar</label>

				<input type="text" class="form-control" name="eva_tit" id="eva_tit" required value="<?=$data->eva_tit;?>">
				<label for="">Indicaciones</label>
				<input type="text" class="form-control" name="eva_des" id="eva_des" required value="<?=$data->eva_des?>">
				<div class="row">
					<div class="col-md-2">
						<label for="">Tiempo</label>
						<div class="input-group clockpicker">
						    <input type="text" class="form-control" value="<?=$data->eva_tim?>" name="eva_tim" id="eva_tim" required>
						    <span class="input-group-addon">
						        <i class="fa fa-clock-o"></i>
						    </span>
						</div>
					</div>

					<div class="col-md-3">
						<label for="">Contraseña</label>
						<input type="password" class="form-control" name="eva_pwr" id="eva_pwr" required>
					</div>
					<div class="col-md-3">
						<label for="">Repite Contraseña</label>
						<input type="password" class="form-control" id="eva_pw2" name="eva_pwr2" required>
					</div>
					<div class="col-md-2">
						<label for="">Promedio</label>
						<input type="number" step="0.01" class="form-control" value="<?=$data->eva_tot?>" name="eva_tot" id="eva_tot" required>
					</div>
					<div class="col-md-2">
						<label for="">Numero intentos Pregunta</label>
						<input type="number" name="eva_num_int" id="eva_num_int" value="<?=$data->eva_num_int?>" class="form-control" required>
					</div>
				</div>
          </div>
              <div class="box-footer">
              	<button class="btn bg-purple" role="button" id="btn_save_eval">Actualizar</button>
              	<a href="<?=base_url()?>admin/updateval" class="btn btn-danger" role="button" id="bnt_cancel_eval">Cancelar</a>
              </div>
              </div>
      	</form>
        </section>

       </div>
<?php } ?>