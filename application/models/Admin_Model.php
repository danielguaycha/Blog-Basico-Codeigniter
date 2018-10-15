<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Model extends CI_Model {

	public function view_art(){
		$sql = "SELECT a.`id_pos`,a.`tit_pos`,a.`sta_pos`,a.`url_pos`,a.`img_pos`,b.id_tem, c.id_sbt FROM `post` a LEFT JOIN temas b on a.`id_pos` = b.id_pos LEFT JOIN subtemas c on c.id_pos = a.id_pos";
		$r = $this->db->query($sql);
	        if($r){
	            return $r;
	        }
        return null;
	}

	public function delete_art($post){
		if($post !== FALSE)
		{
			return $this->db->delete('post', array('id_pos' => $post['id']));
		}	
		return false;
	}

	public function delete_tema($post){
		if($post !== FALSE)
		{
			return $this->db->delete('temas', array('id_tem' => $post['id']));
		}	
		return false;
	}

	public function save_article($post = FALSE, $condicion = FALSE)
	{
		if($post !==FALSE && $condicion !==FALSE)
		{
			//preg_split('/&/',$part[1]);

			$valid = true;		
			$part;
			$id_vid = array();
			if($post['vid_pos']!=""){
				$part = preg_split('/=/',$post['vid_pos']);
				$id_vid = explode("&", $part[1]);
			}else{
				if($condicion ==2){
					$id_vid[0] = $post['vid_pos_old'];
				}else{
					$id_vid[0] = "";
				}
			}
			
			$data = array(
				'tit_pos' => $this->convertir($post['tit_pos']), 
				'des_pos' => $this->convertir($post['des_pos']),
				'cue_pos' => ($post['exist_content']==1)?str_replace("'", '&prime;', $post['cue_pos']):"0",
				'img_pos'=>$post['img_pos'],
				'vid_pos'=>$id_vid[0],
				'url_pos' => url_title($post['tit_pos']),
				'id_use' => 1
			);
			// bloque para guardar
			if($condicion ==1)
			{
				$this->db->trans_begin();
	            if ($this->db->insert('post', $data)) {
	                $id_pos = $this->db->insert_id();
	                // si es un tema general
	                if($post['type_art'] == 0)
	                {
	                	$this->db->query('INSERT INTO `temas`(`id_pos`) VALUES ('.$id_pos.')');
	                }
	                else if($post['type_art']>0)
	                {
	                	$this->db->query('INSERT INTO `subtemas`(`id_pos`, `id_tem`) VALUES ('.$id_pos.', '.$post['type_art'].')');
	                }
	                $r = preg_split('/<|>/',$post['art_refers']);
	                for ($i=0; $i < count($r); $i++) { 
	                	if($r[$i]!=="" && strlen($r[$i])>20)
	                		$this->db->query('INSERT INTO referencias (id_pos, nom_ref) VALUES('.$id_pos.', "'.$this->convertir($r[$i]).'")');
	                }
	            }
	            if ($this->db->trans_status() === FALSE) {
	                $this->db->trans_rollback();
	                $valid = false;
	            } else {
	                $this->db->trans_commit();
	                $valid = true;
	            }
	            return $valid;
	        }
	        //bloque para editar
	        else
	        {
	        	if($post['id_pos']!==NULL && $post['id_pos']!=="")
	        	{

	        		$this->db->trans_begin();
		            if ($this->db->update('post',$data, "id_pos = ".$post['id_pos']." ")) {

		            		// si es un tema general
			            if(!$this->is_tema($post['id_pos'])){
			            	if($this->delete_subt($post['id_pos'])){
			            		$this->db->query('INSERT INTO `subtemas`(`id_pos`, `id_tem`) VALUES ('.$post['id_pos'].', '.$post['type_art'].')');
			            	}
			            }
				            
		            	if($this->delete_refers($post['id_pos']))
		            	{
			                $r = preg_split('/<|>/',$post['art_refers']);
			                for ($i=0; $i < count($r); $i++) { 
			                	if($r[$i]!=="" && strlen($r[$i])>20)
			                		$this->db->query('INSERT INTO referencias (id_pos, nom_ref) VALUES('.$post['id_pos'].', "'.$this->convertir($r[$i]).'")');
			                }
			            }
		            }
		            if ($this->db->trans_status() === FALSE) {
		                $this->db->trans_rollback();
		                $valid = false;
		            } else {
		                $this->db->trans_commit();
		                $valid = true;
		            }
		            return $valid;
		        }else{
		        	return false;
		        }
	        }
		}
		else
		{
			return false;
		}
	}


	public function delete_subt($id_pos){
		if($id_pos !== FALSE)
		{
			return $this->db->delete('subtemas', array('id_pos' => $id_pos));
		}	
		return false;
	}

	public function delete_refers($id_pos = FALSE){
		if($id_pos !== FALSE)
		{
			return $this->db->delete('referencias', array('id_pos' => $id_pos));
		}	
		return false;
	}

	public function get_all_themes(){
    	$sql = "Select a.id_pos, a.tit_pos,b.id_tem from post a JOIN temas b where a.id_pos = b.id_pos and a.sta_pos =1";
    	$r = $this->db->query($sql);
		if($r->num_rows()>0)
			return $r;
		else
			return null;
    }

    public function get_num_sbt_by_tem($id){
    	$sql = "SELECT COUNT(*)as num FROM `subtemas` WHERE id_tem =".$id." ";
		return  $this->db->query($sql)->row()->num;
    }

    public function get_num_eval_by_tem($id){
    	$sql = "SELECT COUNT(*)as num FROM `evaluaciones` WHERE `id_tem` = ".$id." ";
    	return  $this->db->query($sql)->row()->num;
    }

    public function get_post_by_id($id = FALSE)
	{
		if($id !==FALSE)
		{
			$r = $this->db->get_where('post', array('id_pos' => $id), 1);
			return $r->row(); 
		}
		return null;
	}

	public function get_refer_by_id($id = FALSE)
	{
		if($id !==FALSE)
		{
			$r = $this->db->get_where('referencias', array('id_pos' => $id));
			return $r; 
		}
		return null;
	}

	public function is_tema($id){
		$r = $this->db->get_where('temas', array('id_pos' => $id));
		if($r->num_rows()>0){
			return true;
		}
		return false;
	}

	


	/*--------------------------------EVALUACIONES-------------------------------------------*/

	//rediseño del Algoritmo
	public function get_rs_by_eval($id_eva)
	{
		$r = $this->db->query("SELECT (SELECT nom_nrg FROM user_nrg WHERE user_eval.id_nrg = id_nrg )as nombre, `id_eva`,`nota` FROM `user_eval` WHERE `id_eva` = ".$id_eva." ");
		if($r)
			return $r;

	}

	public function guardar_pregunta($post = FALSE){
		if($post!==FALSE){
			$resp = explode(";", $post['respuestas']);
			$letters = array(0 =>"a",1=>"b", 2=>"c", 3=>"d", 4=>"e", 5=>"f",6=>"g");
			if(count($resp)>=2){
				$this->db->trans_begin();
				$r = $this->db->query("INSERT INTO `preguntas`(`pre_num`, `pre_def`, `pre_rsp`,`id_eva`) VALUES (0,'".$post['pre_def']."','".$post['pre_rsp']."',".$post['id_eva'].")");
				if($r)
				{
					$id_pre = $this->db->insert_id();

					for ($i=0; $i <count($resp) ; $i++) { 
						if($resp[$i]!=""){
							$this->db->query("INSERT INTO `literales`(`lit_cue`, `lit_vin`, `id_pre`) VALUES ('".$resp[$i]."','".$letters[$i]."', ".$id_pre." )");
						}
					}
				}
				if ($this->db->trans_status() === FALSE)
				{
				        $this->db->trans_rollback();
				        return "No se puedo completar la operacion";
				}
				else
				{
				        $this->db->trans_commit();
				        return "Pregunta guardada correctamente";
				}

			}else{
				return "Necesitas mas de dos preguntas";
			}
		}

		return "";
	}


	public function get_all_topics(){
		$sql = "SELECT `id_pos`,`tit_pos` FROM `post` WHERE `id_pos`IN(SELECT `id_pos` FROM temas)";
		$r = $this->db->query($sql);
	        if($r){
	            return$r;
	        }
        return null;	
	}

	public function get_evals(){
		$sql = "SELECT `id_eva`,`eva_sta`,`eva_tit`, (SELECT COUNT(id_eva) FROM preguntas WHERE id_eva = evaluaciones.id_eva)as preguntas, `eva_pwr` FROM `evaluaciones`";
		$r = $this->db->query($sql);
	        if($r){
	            return$r;
	        }
        return null;	
	}

	public function get_eval_by_id($id){
		if($id>0){
			$r = $this->db->get_where('evaluaciones', array('id_eva' => $id), 0, 1);
			 if($r->num_rows()>0){
			 	return $r->row();
			 }
		}
		return null;
	}

	public function exist_eval($id){
		if($id>0){
			$r = $this->db->get_where('evaluaciones', array('id_eva' => $id), 0, 1);
			 if($r->num_rows()>0){
			 	return true;
			 }
		}
		return false;
	}

	public function get_tem_by_post($id){
		$r = $this->db->query("SELECT `id_tem` FROM `temas` WHERE `id_pos`= ".$id." ");
		if($r->num_rows()>0){
			return $r->row()->id_tem;
		}
		return 0;
	}

	public function save_eval($post){
		$data = array(
			 		'eva_tit' => $this->convertir($post['eva_tit']),
			 		'eva_des' => $this->convertir($post['eva_des']),
			 		'eva_url' => url_title($post['eva_tit']),
			 		'eva_tim' => $post ['eva_tim'],
			 		'eva_num_int' => $post ['eva_num_int'],
			 		'eva_tot' => $post['eva_tot'],
			 		'eva_pwr'=>$post['eva_pwr'],
			 		'id_tem'=> $this->get_tem_by_post($post['id_tem'])
					);
		  if($this->db->insert('evaluaciones', $data))
                return true;
         return false;
	}

	public function update_eval($post){
		if($post['id_eva']>0){
			$data = array(
			 		'eva_tit' => $this->convertir($post['eva_tit']),
			 		'eva_des' => $this->convertir($post['eva_des']),
			 		'eva_url' => url_title($post['eva_tit']),
			 		'eva_tim' => $post ['eva_tim'],
			 		'eva_num_int' => $post ['eva_num_int'],
			 		'eva_tot' => $post['eva_tot'],
			 		'eva_pwr'=>$post['eva_pwr']
					);
			if($this->db->update('evaluaciones', $data, "id_eva = ".$post['id_eva']."")){
				return true;
			}
		}
		
	return false;
		
	}

	public function get_qt_by_eval($id_eval){
		$sql = "SELECT COUNT(id_eva)as num FROM preguntas WHERE id_eva =".$id_eval." ";
		return  $this->db->query($sql)->row()->num;
	}



	 public function convertir($content =''){
        $content= str_replace("'", '&prime;', $content);
        $content= str_replace('"', "'", $content);
        //$content= str_replace("/", '&#47;', $content);
        //$content= str_replace("\", '&#92;', $content);

        return $content;
    }

    public function save_qsr($post){
    	$qr = preg_split('/,/', $post['qs']);
    	$qsr = preg_split('/,/', $post['qsr']);
    	$rsp = preg_split('/,/', $post['rsp']);

    	$this->db->trans_begin();
    	for ($i=0; $i <count($qr); $i++) 
    	{ 
    		$qrr = preg_split('/;/', $qr[$i]);
    		if($this->db->query('INSERT INTO `preguntas`(`pre_num`, `pre_def`, `pre_rsp`, `id_eva`) VALUES ('.$qrr[0].',"'.$qrr[1].'","'.$rsp[$i].'",'.$post['id_eva'].');'))
    		{
    			$id_pre = $this->db->insert_id();

    			for ($j=0; $j < count($qsr); $j++) 
    			{ 
    				$qsrr = preg_split('/;/', $qsr[$j]);
    				if($qsrr[0] == ($i+1))
    				{
    					$this->db->query('INSERT INTO `literales`(`lit_cue`, `lit_vin`, `id_pre`) VALUES ("'.$qsrr[2].'","'.$qsrr[1].'",'.$id_pre.')');
    				}
    			}

    		}
    	}
		if ($this->db->trans_status() === FALSE)
		{
		        $this->db->trans_rollback();
		        return false;
		}
		else
		{
		        $this->db->trans_commit();
		        return true;
		}
		return false;
    }

    

}

/* End of file Admin.php */
/* Location: ./application/models/Admin.php */