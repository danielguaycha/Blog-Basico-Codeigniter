 <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="box box-default color-palette-box">
              <div class="box-header with-border">
                <h3 class="box-title"><i class="fa fa-book">&nbsp;</i> Actualizar Articulo</h3>
              </div>
              <div class="box-body"> 
                  <?php if ($consulta!== NULL): ?>
                    <table class="table table-condensed table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th class="col-md-8">Titulo</th>
                          <th>Estado</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 

                        $temas =$this->db->query("SELECT a.`id_pos`,a.`tit_pos`,a.`sta_pos`,a.`url_pos`,a.`img_pos`,b.id_tem FROM `post` a JOIN temas b on a.`id_pos` = b.id_pos ORDER BY b.id_tem ASC");

                        foreach ($temas->result() as $temas) {

                          echo '<tr class="success">
                            <td>'.$temas->id_tem.'</td>
                            <td>'.$temas->tit_pos.'</td>
                            <td>'.$temas->sta_pos.'</td>
                            <td>
                                <a href="'.base_url().'admin/addart?edit='.$temas->id_pos.'" class="btn btn-md btn-success" title="Modificar"><i class="fa fa-pencil"></i></a>

                              <a class="btn btn-md btn-danger btn-delete" data-id="'.$temas->id_tem.'" data-type="tm" title="Eliminar" data-request="'.base_url().'admin/delart"><i class="fa fa-trash"></i></a>

                              <a class="btn btn-md bg-aqua" title="Vista preeliminar" href="'.base_url().'articulo/view_article/'.$temas->url_pos.'"><i class="fa fa-eye" ></i></a>
                            </td>
                          </tr>';

                          $subtemas = $this->db->query("SELECT a.`id_pos`,a.`tit_pos`,a.`sta_pos`,a.`url_pos`,a.`img_pos`,b.id_sbt FROM `post` a JOIN subtemas b on a.`id_pos` = b.id_pos AND b.id_tem = ".$temas->id_tem." ORDER BY b.id_tem ASC");
                          foreach ($subtemas->result() as $subt) {
                            echo '<tr>
                            <td>'.$subt->id_pos.'</td>
                            <td>'.$subt->tit_pos.'</td>
                            <td>'.$subt->sta_pos.'</td>
                            <td>
                                <a href="'.base_url().'admin/addart?edit='.$subt->id_pos.'" class="btn btn-md btn-success" title="Modificar"><i class="fa fa-pencil"></i></a>

                               <a class="btn btn-md btn-danger btn-delete" data-id="'.$subt->id_sbt.'" data-type="sbt" title="Eliminar" data-request="'.base_url().'admin/delart"><i class="fa fa-trash"></i></a>

                                <a class="btn btn-md bg-aqua" title="Vista preeliminar" href="'.base_url().'articulo/view_article/'.$subt->url_pos.'"><i class="fa fa-eye" ></i></a>
                            </td>
                          </tr>';
                          }
                        }

                       ?>
                
                      </tbody>
                    </table>
                  <?php else: ?>
                    <div class="alert alert-danger">
                      Aun no hay articulos para mostrar
                    </div>
                  <?php endif ?>
                  
              </div><!-- /.box-body -->
            </div>
        </section>
      </div>