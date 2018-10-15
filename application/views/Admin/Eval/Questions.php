<div class="content-wrapper" style="">
        <!-- Main content -->
        <section class="content">
        <div class="box box-success color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Agregar Preguntas |&nbsp; <?=$eval->eva_tit?></h3>
              </div>
             <div class="box-body"> 
             <div class="row">

<div class="col-md-12">
	<?php if($this->input->get('add'))
			{
				if($this->input->get('add')==1){
					echo("<br><div class='alert alert-success'>Pregunta Agredada correctamente!.</div>");
				}else if ($this->input->get('add')==0){
					echo("<br><div class='alert alert-success'>Por Alguna Razon sus cambios no se guardaron, porfavor intente nuevamente</div>");
				}
			}
	 ?>
	<h5>Preguntas de una sola opción</h5> <a class="btn btn-primary insert_qt"><i class="fa fa-plus"> </i> Insertar</a><br>
	    <div class="row">
		<div class="col-md-12 qt-add">
		   <?php
		    $def ="";
		   	$q =$this->db->query("SELECT * FROM `preguntas` WHERE `id_eva` =".$this->input->get('test')." ");
		   	if($q->num_rows()>0){
		   		$n =0;
		   		foreach ($q->result() as $f) {
		   			$def.= '
					<article class="clearfix question-section" id="'.$f->id_pre.'">
			    	<div class="question-body"><div class="qt"> <span class="tit_pre"><span class="num"><b>&nbsp; '.($n + 1).' - &nbsp;</b></span><b>'.$f->pre_def.'</b></span> <div class="contenedor_opciones_respuesta"><table>';

		   			$l = $this->db->query("SELECT * FROM `literales` WHERE `id_pre` =".$f->id_pre." ");
		   			foreach ($l->result() as $g) {
		   				$def.='
							<tr>
								<td><b>'.$g->lit_vin.'</b> &nbsp;- &nbsp;</td>
								<td>'.$g->lit_cue.'</td>
							</tr>
		   				';
		   			}

		   			$def.='</table>
			            </div>
			            <div class="question-overlay">
			                <div class="question-insert">
			                    <div class="btn-group">
			                        <div class="btn btn-info" style="z-index:9;">Opciones:</div>
			                        <a href="" class="open_modal btn btn-primary" role="button"> <i class="fa fa-check-square-o"></i> Nueva</a>
			                        <a href="'.base_url().'admin/eliminar_preg/'.$f->id_pre.'/'.$this->input->get('test').'" class="btn btn-danger" role="button" data-index="'.($n + 1).'"> <i class="fa fa-check-square-o"></i> Eliminar</a>
			                    </div>
			                </div>
			            </div>
			            <div class="rps-preg"><b>Respuesta Correcta: </b> '.$f->pre_rsp.'</div></article>';


		   		echo $def;
		   		$def="";
		   		$n++;
		   		}
		   	}else{
		   		echo("<br><div class='alert alert-danger'>Aun no se han agregado preguntas paara esta evaluación.</div>");
		   	}
		   ?>
			
		</div>
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
                <form action="<?=base_url()?>admin/guardar_pregunta" id="frm_guardar_preguntas" method="post">
                	<input type="hidden" name="respuestas" id="respuestas" value="">
                	<input type="hidden" name="id_eva" id="id_eva" value="<?=$this->input->get('test')?>">
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
                                <button type="button" class="btn btn-success" id="btn_guardar_pregunta">Confirmar</button>
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
				<div class="row">
					
				</div>
             </div>
             <div class="box-footer">
 
             </div>
        </div>

 </div>


