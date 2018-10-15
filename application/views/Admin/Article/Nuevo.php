
      <?php
        if($this->input->get('edit')==null || $this->input->get('edit') ==""){
      ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        <form id="save_article" type="post" action="<?=base_url()?>admin/save_art" enctype="multipart/form-data">
            <div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Nuevo Articulo</h3>
              </div>
              <div class="box-body">   
                  <label for="">Seleccione el tipo de Articulo que va a crear</label>
                  <input type="hidden" name="option" value="1">  
                  <select class="form-control" name="type_art" id="type_art">
                    <option value="0">Tema General</option>
                    <?php if ($articulos!=null): ?>
                       <?php foreach ($articulos->result() as $row): ?>
                        <option value="<?=$row->id_tem?>"><?=$row->tit_pos?></option>
                      <?php endforeach ?>                      
                    <?php endif ?>
                     
                  </select>        
                  <label>Titulo</label><br>
                  <input type="text" name="tit_pos" id="tit_pos"  class="form-control"><br>
                  <label>Descripcion: </label>
                  <input type="text" name="des_pos" id="des_post"  class="form-control"><br>
                   <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                         <label>Portada</label>
                         <input type="file" name="userfile" id="userfile">
                          <p class="help-block">
                          <span class="label label-sm label-danger">Nota:</span>
                          &nbsp;Porfavor comprima la imagen <a href="https://compressor.io/compress" target="_blank">Aqui</a> antes de ser subida.</p>
                      </div>     
                      </div>
                    <div class="col-md-6">
                      <label for="">Video (Opcional)</label>
                      <input type="text" name="vid_pos" id="vid_pos" class="form-control"></div>
                    </div>
                <div class="row">

                <div class="col-md-12">
                
                  <div style="border: 1px solid #eee;padding: 20px 5px;" class="material-switch" style=""><b style="margin-right: 10px;">Adicionar Contenido</b>&nbsp;&nbsp;
                            <input id="add_content" name="add_content" type="checkbox"/>
                            <label for="add_content" class="label-primary"></label>
                            <input type="hidden" value="0" name="exist_content" id="exist_content">
                  </div>
                </div>
                <div class="col-md-12">
                  <textarea name="cue_pos" id="cue_pos" class="cont_art" cols="20" rows="10"  class="form-control"></textarea><br>
                    <label for="">Referencias  |  </label>&nbsp;&nbsp;<button id="btn_new_refer">Nueva</button><br><br>
                    <div class="refers">
                      <input type="text" id="r_1" class="form-control"><br>
                      <input type="text" id="r_s2" class="form-control"><br>
                      <input type="text" id="r_3" class="form-control"><br>
                    </div>
                    <div class="blok-content"></div>
                </div>
                    
                
                </div>
                  
              </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="button" id="btn_save" value="Guardar" class="btn">
                  <input type="button" id="btn_cancel" value="Cancelar" class="btn">
              </div>
            </div>
        </form>
        </section>
      </div>
      <?php 
      }else{?>
        
       <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
        <form id="save_article" type="post" action="<?=base_url()?>admin/save_art" enctype="multipart/form-data">
            <div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-tag"></i> Actualizar Articulo</h3>
              </div>
              <div class="box-body">   
                  <label for="">Seleccione el tipo de Articulo que va a crear</label>  
                  <input type="hidden" name="option" value="2">  
                  <input type="hidden" name="id_pos" value="<?=$p->id_pos?>">
                  <input type="hidden" name="img" value="<?=$p->img_pos?>">
                  <input type="hidden" name="vid_pos_old" value="<?=$p->vid_pos?>">
                  <select class="form-control" name="type_art" id="type_art">
                    <?php if ($is_tem): ?>
                      <option value="0">Tema General</option>
                    <?php else: ?>
                      <?php foreach ($articulos->result() as $row): ?>
                        <option value="<?=$row->id_tem?>">Subt de  - <?=$row->tit_pos?></option>
                      <?php endforeach ?>
                    <?php endif ?>                      
                  </select>        
                  <label>Titulo</label><br>
                  <input type="text" name="tit_pos" id="tit_pos"  class="form-control" value="<?=$p->tit_pos?>"><br>
                  <label>Descripcion: </label>
                  <input type="text" name="des_pos" id="des_post"  class="form-control" value="<?=$p->des_pos?>"><br>
                   <div class="row">
                    <div class="col-md-6">
                    <center><img src="<?=base_url()?>public/img/post/<?=$p->img_pos?>" width="200"></center>
                      <div class="form-group">
                         <label>Portada</label>
                         <input type="file" name="userfile" id="userfile" value="<?=$p->img_pos?>">
                          <p class="help-block">
                          <span class="label label-sm label-danger">Nota:</span>
                          &nbsp;Porfavor comprima la imagen <a href="https://compressor.io/compress" target="_blank">Aqui</a> antes de ser subida.</p>
                      </div>     
                      </div>
                    <div class="col-md-6">
                      <label for="">Video (Opcional)</label>
                      <input type="text" name="vid_pos" id="vid_pos" class="form-control" value="https://www.youtube.com/watch?v=<?=$p->vid_pos?>"></div>
                    </div>
                <div class="row">

                <div class="col-md-12">
                
                  <div style="border: 1px solid #eee;padding: 20px 5px;" class="material-switch" style=""><b style="margin-right: 10px;">Adicionar Contenido</b>&nbsp;&nbsp;
                            <input id="add_content" <?= ($p->cue_pos!="0")?'checked="checked"':'';?>  name="add_content" type="checkbox"/>
                            <label for="add_content" class="label-primary"></label>
                            <input type="hidden" value="<?= ($p->cue_pos!="0")?1:'0';?>" name="exist_content" id="exist_content">
                  </div>
                </div>
                <div class="col-md-12">
                  <textarea name="cue_pos" id="cue_pos" class="cont_art" cols="20" rows="10"  class="form-control">
                    <?php 
                      if ($p->cue_pos !="0") {
                        echo $p->cue_pos;
                      }
                     ?>
                  </textarea><br>
                    <label for="">Referencias  |  </label>&nbsp;&nbsp;<button id="btn_new_refer">Nueva</button><br><br>
                    <div class="refers">
                      <?php $i=0; ?>
                      <?php foreach ($r->result() as $f): ?>
                         <input type="text" id="r_<?=($i+1)?>" class="form-control" value="<?=$f->nom_ref?>"><br>
                         <?php $i++; ?>
                      <?php endforeach ?>
                   
                    </div>
                    <div class="blok-content" style="<?=($p->cue_pos!="0")?'display: none;':'';?>"></div>
                </div>
                    
                
                </div>
                  
              </div><!-- /.box-body -->
              <div class="box-footer">
                  <input type="button" id="btn_save" value="Guardar" class="btn">
                  <input type="button" id="btn_cancel" value="Cancelar" class="btn">
              </div>
            </div>
        </form>
        </section>
      </div>
      <?php } ?>
