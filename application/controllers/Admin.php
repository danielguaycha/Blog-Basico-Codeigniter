<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Admin_Model');
		$this->load->model('Login_model');
	}

	public function login(){  
	    if(!$this->session->userdata('login')){
	      $this->load->view('login');
	      }else{
	        redirect('admin','refresh');
	    }
  	}

  	public function login_user(){

	    if($this->input->is_ajax_request())
	    {
	      $post = $this->input->post();
	      if($post){
	          $mensaje ="";
	          $respuesta ="done";
	          $html ="";
	          $acceso = false;
	          $url ="";
	          $data = array();
	          $result;
	          switch ($post['case']) {
	            case 1:
	              #valida el usuario
	               if($post['username']){
	                  $result = $this->Login_model->get_user_by_name($post);
	                  if($result !=null)
	                  {

	                    //$this->session->sess_destroy();
	                    $data['nombre'] = $result->nom_use.' '.$result->ape_use;
	                    $data['id_usuario'] = $result->id_use;
	                    $data['username'] = $post['username'];
	                    $data['avatar_admin'] = $result->img_user;
	                    $html='<img style=" height: 100px;width: 100px;border-radius: 100px; border: solid #45b6af;" src="'.base_url().'public/img/'.$result->img_user.'">';
	                    $result->img_user;

	                    $this->session->set_userdata($data);
	                    $mensaje=$result->nom_use.' '.$result->ape_use;
	                    $respuesta ="done";
	                  }
	                  else
	                  {
	                    $mensaje ="usuario ".$post['username']." no encontrado";
	                    $respuesta = "bad";
	                  }
	                }
	              break;
	            case 2:
	              if($post['password'])
	              {
	                $r = $this->Login_model->get_pass_by_user($this->session->userdata('id_usuario'),$post['password']);
	                if($r){
	                  $this->session->set_userdata('login', 'true');

	                  $mensaje ="Bienvenido al sistema..";
	                  $acceso = true;
	                  $url =base_url().'admin';
	                  $respuesta ="done";
	                }else{
	                  $mensaje ="Contraseña incorrecta";
	                  $respuesta ="bad";
	                }
	              }
	              break;
	            default:
	              $mensaje ="Proceso incorrecto";
	              break;
	          }
	          $datajson = array('m' =>$mensaje, 'r' =>$respuesta,'html'=>$html, 'acceso'=>$acceso,'url'=>$url);

	          echo json_encode($datajson);
	        
	      }

	      else{
	        $d = array('r' =>'bad' ,'m'=> 'ya valiste' );;
	      }
	    }
	    else{
	      show_404();
	    }
	  }

	  public function logout(){
	    if($this->session->userdata('login'))
	    {
	      $this->session->sess_destroy();
	         header("Location: " . base_url());
	    }else{
	      show_404();
	    }
	        
	    }

  	/*-------------------------------------------------------------*/
	public function index()
	{
		if($this->session->userdata('login')){
			//redirect('admin/login','refresh');
			//$this->load->view('Admin/header');	
			//$this->load->view('Admin/footer');
			redirect('admin/addart','refresh');
		}else{
			show_404();
		}
	}

	public function delart(){
		if($this->input->is_ajax_request())
	    {
	        $respuesta = "done";
	        $msg ="";
	        $post = $this->input->post();
	        if(isset($post['clic']) && $post['clic']==true)
	        {

	         if($post['type'] =="tm"){

				if($this->Admin_Model->get_num_sbt_by_tem($post['id'])>=1){
					$msg ="No puedes eliminar este tema, debido a que posee ".$this->Admin_Model->get_num_sbt_by_tem($post['id'])." subtemas asignados";
	         		$respuesta="bad";
				}else if ($this->Admin_Model->get_num_eval_by_tem($post['id'])>0){
					$msg ="No puedes eliminar este tema, debido a que posee evaluaciones asignadas";
	         		$respuesta="bad";
				}else{
					$result = $this->Admin_Model->delete_tema($post);
		          	if($result){
		            	$msg ="Sus datos se eliminaron con exito! nms";
		            }else{
			            
			            $msg ="Ocurrio un error durante el proceso contactese con el Administrador";
			            $respuesta ="bad";
	          		}
				}
	         	
	        }else if($post['type']=="sbt"){
	         	$result = $this->db->delete('subtemas', array('id_sbt' => $post['id']));
				if($result){
					$msg ="Sus datos se eliminaron con exito! :V:V";
				}else{
					$respuesta ="bad";
					$msg ="Ocurrio un error durante el proceso contactese con el Administrador";
				}
	         }
	          

	          $salidaJSON=array("r" => $respuesta,"m" => $msg);
	          echo (json_encode($salidaJSON));
	        }
	        else
	        {
	          header('location:'.base_url().'admin/updart');
	        }
	    }
	    else
	    {
	      show_404();
	    }
	}

	public function updart(){
		$data = array();
		$data['consulta'] = $this->Admin_Model->view_art();
		$this->load->view('Admin/header',$data);	
		$this->load->view('Admin/Article/Update');
		$this->load->view('Admin/footer');
	}

	public function addart(){
	if($this->session->userdata('login')){
		$data = array();

		$data['ckeditor']= true;
		$data['articulos'] = $this->Admin_Model->get_all_themes();

		if($this->input->get('edit') ==null || $this->input->get('edit') =="")
		{
			$this->load->view('Admin/header',$data);	
		}
		else{
			$p = $this->Admin_Model->get_post_by_id($this->input->get('edit'));
			$r = $this->Admin_Model->get_refer_by_id($this->input->get('edit'));
			if($p!=null){
				$data['p'] = $p;
				$data['r']=$r;
				$data['is_tem'] = $this->Admin_Model->is_tema($this->input->get('edit'));
				$this->load->view('Admin/header',$data);
			}else{
				redirect('admin/addart','refresh');
			}
		}
		
		$this->load->view('Admin/Article/Nuevo');	
		$this->load->view('Admin/footer');	
	}else{
		redirect('admin/login','refresh');
	}
	}

	public function delete_eval($id = FALSE){
		if($id !== FALSE){
			if($id>0){
				  if($this->db->delete('evaluaciones', array(
	                'id_eva' => $id
	            ))){
				  	redirect('admin/updateval?op=1','refresh');
				  }
            }
		}else{
			redirect('admin','refresh');
		}
	}


	public function updateart(){
		if($this->session->userdata('login')){
		$this->load->view('Admin/header');	
		$this->load->view('Admin/Article/Update');	
		$this->load->view('Admin/footer');	
		}
		else{
			redirect('admin/login','refresh');
		}
	}

	public function save_art(){
		if($this->input->is_ajax_request())
		{
			$mensaje ="";
			$resp ="done";

			$post = $this->input->post();
			if($post!=null)
			{	
				if($post['option']==1)
				{
					if($_FILES['userfile']['tmp_name'] !="" && $_FILES['userfile']['tmp_name']!=null)
					{
						$img_pos = $this->upload_img($_FILES['userfile'],'./public/img/post/',false);
		                if($img_pos !="")
		                 	 $post['img_pos'] = $img_pos;
					}else{
						$post['img_pos']='';
					}
					
				
					if($this->Admin_Model->save_article($post,1))
						$mensaje="Tus datos fueron procesados";
					else
					{
						$mensaje="Tus datos NO fueron procesados";
						$resp = 'bad';
					}
				}else if($post['option']==2){

					if($post['id_pos']>0){
					//eliminar imagen actual
						if($_FILES['userfile']['tmp_name']!="" && $_FILES['userfile']['tmp_name']!=null)
						{
							if($post['img']!=""){
								if(file_exists('./public/img/post/'.$post['img']))
		                   		{
		                   			unlink('./public/img/post/'.$post['img']);
		                   		}
							}
							

	                   		$img_pos = $this->upload_img($_FILES['userfile'],'./public/img/post/',false);
			                if($img_pos !="")
			                 	 $post['img_pos'] = $img_pos;
						}
						//subir nueva img
						else{
							$post['img_pos']=$post['img'];
						}

						

						if($this->Admin_Model->save_article($post,2))
							$mensaje="Tus datos fueron actualizados.";
						else
						{
							$mensaje="Tus datos NO fueron actualizados.";
							$resp = 'bad';
						}
						
					}else{
						$mensaje="Hay problemas al identificar el articulo..";
						$resp="bad";
					}
				}
				 			
			}
			else
			{
				$mensaje="Algunos datos son requeridos";
				$resp="bad";
			}

			$dataJson = array('m' => $mensaje, 'r'=> $resp );
			echo json_encode($dataJson);

		}
		else
		{
			redirect('index.php','refresh');
		}
	}
	/***============================================================***/

	public function guardar_pregunta(){
		$post =$this->input->post();
		if($post){
			$r = $this->Admin_Model->guardar_pregunta($post);
			if($r!=""){
				redirect('admin/addqt?test='.$post['id_eva'].'&add=1','refresh');
			}else{
				redirect('admin/addqt?test='.$post['id_eva'].'&add=2','refresh');
			}
		}
	}

	public function eliminar_preg($id_pre = FALSE, $id_eva=FALSE ) {
		if($id_eva !==FALSE and $id_pre!==FALSE){
			if($this->Admin_Model->exist_eval($id_eva)){
				 if($this->db->query("DELETE FROM `preguntas` WHERE `id_pre`= ".$id_pre." and `id_eva` = ".$id_eva." ")){
					  	redirect('admin/addqt?test='.$id_eva.' ','refresh');
				}
			}
		}
	}

	public function addqt(){
		//$this->output->enable_profiler(TRUE);
		if($this->input->get('test')>0){
			$data = array();
			$id = $this->input->get('test');
			if($this->Admin_Model->exist_eval($id)){

				$data['eval'] = $this->Admin_Model->get_eval_by_id($id);
				$this->load->view('Admin/header',$data);
				$this->load->view('Admin/Eval/Questions');	
				$this->load->view('Admin/footer');				
			}else{
				echo "no existe";
				//redirect('admin/updateval','refresh');
			}
		}else{
			echo "Mo es mayor a cero";
			//redirect('admin/updateval','refresh');
		}

	}

	public function resultado_qt($id_eva = FALSE){
		if($id_eva !== FALSE){
			if($this->Admin_Model->exist_eval($id_eva)){
				$data = array();
				$data['rs'] = $this->Admin_Model->get_rs_by_eval($id_eva);
				$data['eval'] = $this->Admin_Model->get_eval_by_id($id_eva);
				$this->load->view('Admin/header',$data);
				$this->load->view('Admin/Eval/Notas');	
				$this->load->view('Admin/footer');		
			}

		}else{
			show_404();
		}
	}

/***============================================================***/
	public function addeval(){
		if($this->session->userdata('login')){
			$data = array();
			$data['consulta'] = $this->Admin_Model->get_all_topics();
			if($this->input->get('edit')>0){
				if($this->Admin_Model->exist_eval($this->input->get('edit'))){
					$r = $this->Admin_Model->get_eval_by_id($this->input->get('edit'));
					if($r!=null){
						$data['data'] = $r;
					}
					$this->load->view('Admin/header', $data);
				}else{
					redirect('Admin/addeval','refresh');
				}
				
			}else{
				$this->load->view('Admin/header', $data);	
			}

			$this->load->view('Admin/Eval/Nuevo_eva');	
			$this->load->view('Admin/footer');	
		}else{
			redirect('admin/logib','refresh');
		}
		
	}

	public function updateval(){
		if($this->session->userdata('login')){
			$data = array();
			$data['consulta'] = $this->Admin_Model->get_evals();
			$this->load->view('Admin/header',$data);	
			$this->load->view('Admin/Eval/Update');	
			$this->load->view('Admin/footer');	
		}else{
			redirect('admin/login','refresh');
		}
	}

	public function save_eval(){
	 // if($this->input->is_ajax_request()){
	  	  $mensaje="";
	      $respuesta="done";

	      $post = $this->input->post();

      	 if($post){
	      	 	if($post['option'] ==1){
	      	 		if($post['eva_pwr']==$post['eva_pwr2']){
			      		if($this->Admin_Model->save_eval($post))
			      		{
			      			$mensaje="Genial! tus datos fueron procesados con exito";
			      		}else{
			      			$mensaje="Error al guardar los datos";
			      			$respuesta="bad";
			      		}
	      	 		}else{
			      		$mensaje="Las contraseñas no coinciden";
			      		$respuesta="bad";
			      	}
	      		}else if($post['option']==2 && $post['id_eva']>0){
	      			if($this->Admin_Model->update_eval($post)){
	      				$mensaje ="Sus datos fueron actualizados con exito!";
	      			}else{
	      				$mensaje ="Error al actualizar los datos";
	      				$respuesta ="bad";
	      			}
	      		}
	      }else{
	      	$mensaje ="Error al procesar la información!";
	      	$respuesta="bad";
	      }

		$datajson = array('r' => $respuesta,'m'=>$mensaje );
		echo json_encode($datajson);
	 // }else{
	  //	show_404();
	  	//echo "valiste";
	  //}
	}

	
	public function save_qsr(){
		if($this->input->is_ajax_request()){
			$mensaje="";
			$respuesta="done";
			$post = $this->input->post();
			if($post['id_eva']>0 &&  $this->Admin_Model->exist_eval($post['id_eva']))
			{

				if($this->Admin_Model->save_qsr($post)){
					$mensaje="Sus pregunras fueron Guardadas";
				}else{
					$mensaje="Problemas al guardar los datos";
					$respuesta ="bad";
				}
				//$mensaje = count(preg_split('/,/', $post['qs']));
			}
			$datajson = array('r' => $respuesta,'m'=>$mensaje );
			echo json_encode($datajson);
		}else{
			echo "string";
		}
	}



	private function upload_img($img = FALSE, $path = FALSE,$resize = FALSE, $width = FALSE, $height = FALSE){
	    $validar = true;
	    $name_img;
	    $cantidad= count($img["tmp_name"]);
	    
	    if($cantidad == 1)
	    {
	      $name ="";
	      $imagen_base=$img['tmp_name'];
	          $size = getimagesize($imagen_base);
	              switch($size["mime"]){
	                  case "image/jpeg":
	                     $name = md5(rand(1,999)).'.jpeg';
	                      break;
	                  case "image/jpg":
	                      $name = md5(rand(1,999)).'.jpg';
	                      break;
	                  case "image/gif":
	                      $name = md5(rand(1,999)).'.gif';
	                      break;
	                  case "image/png":
	                      $name = md5(rand(1,999)).'.png';
	                      break;
	              }
	      
	      if($resize)
	      {
	        move_uploaded_file($img["tmp_name"],'./public/temp/'.$name);
	        if($width == FALSE && $height == FALSE)
	          $this->tes_model->resize($path,'./public/temp/'.$name,800,430);
	        else
	          $this->tes_model->resize($path,'./public/temp/'.$name,$width,$height);
	      }
	      else
	      {
	        move_uploaded_file($img["tmp_name"],$path.$name);
	      }

	      $name_img = $name;
	    }
	    else
	    {
	      for ($i=0; $i<$cantidad; $i++)
	      {
	        $name_="";
	        $imgbase=$img['tmp_name'][$i];
	            $s = getimagesize($imgbase);
	              
	              switch($s["mime"]){
	                  case "image/jpeg":
	                     $name_ = md5(rand(1,999)).'.jpeg';
	                      break;
	                  case "image/jpg":
	                      $name_ = md5(rand(1,999)).'.jpg';
	                      break;
	                  case "image/gif":
	                      $name_ = md5(rand(1,999)).'.gif';
	                      break;
	                  case "image/png":
	                      $name_ = md5(rand(1,999)).'.png';
	                      break;
	              }
	        
	        //$name_ = md5(rand(1,999)).'.jpg';
	        if($resize)
	        {
	          move_uploaded_file($img["tmp_name"][$i],'./public/temp/'.$name_);
	          if($width == FALSE && $height == FALSE)
	            $this->tes_model->resize($path,'./public/temp/'.$name_,200,200);
	          else
	            $this->tes_model->resize($path,'./public/temp/'.$name_,$width,$height);
	        }
	        else
	        {
	          move_uploaded_file($img["tmp_name"][$i],$path.$name_);
	        }
	        $name_img[$i] = $name_;
	        
	      }
	    }
	    return $name_img;
  }



}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */