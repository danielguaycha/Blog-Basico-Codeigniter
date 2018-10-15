<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Inicio_model');
	}
	public function index()
	{
		//$this->output->enable_profiler(TRUE);
		$this->load->view('Inicio/index');
		
	}

	public function post($title = FALSE){

		if($title !==FALSE){
			$data = array();
			$data['consulta'] =$this->Inicio_model->get_post_by_title($title); 
			$data['refer']= $this->Inicio_model->get_refer_by_post($data['consulta']->id_pos);
			if($data['consulta']->vid_pos !=""){
				$data['vid'] = '<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$data['consulta']->vid_pos.'" frameborder="0" allowfullscreen></iframe>';
			}else{
				$data['vid']="";
			}
				
			$this->load->view('Inicio/head',$data);
			$this->load->view('Inicio/articulo/post');
			$this->load->view('Inicio/footer');
			
		}else{
			redirect('inicio','refresh');
		}
		
	}

	public function evaluacion($title = FALSE){
		//$this->output->enable_profiler(TRUE);
		if($title !==FALSE){
			$data = array();

			$data['eval'] = $this->Inicio_model->get_eval_by_title($title);
			//$data['das'] = $this->Inicio_model->obtener_cuestionario($data['eval']->id_eva);
			$data['is_eval'] = true;
			if($data['eval']!=null){
				$this->load->view('Inicio/head',$data);
				$this->load->view('Inicio/eval/eval');
				$this->load->view('Inicio/footer');
			}else{
				redirect('inicio','refresh');
			}
			
		}else{

		}
	}

	public function iniciar_prueba(){
		if($this->input->is_ajax_request()){
		 $mensaje ="";
          $respuesta ="done";
          $html ="";
          $time =0;
          $aviso=0;
          $pass="";
			$data = array();
			$post = $this->input->post();
			if(isset($post['name'])){
				
				$u = $this->Inicio_model->comprobar_usuario($post['name']);
				if($u<0){
					$u = $this->Inicio_model->insert_usuario($post['name']);
				}

				if($this->Inicio_model->rindio_prueba($u, $post['id_eva'])){
					$html='<div class="art"><div class="row"><div class="col-md-12" style="margin: 0 auto;"><div class="content" style="padding:20px;"><h3>Upps!</h3>
						<p>Al parecer ya has realizado esta evaluación, no se permiten mas intentos con este nombre.</p>
						<center><a href="'.base_url().'" class="btn btn-success">Ir al Inicio</a></center>
					</div></div></div></div>';
					$mensaje="Usted ya ha realizado esta evaluación, No se permiten más intentos";
					$respuesta="done";
					$aviso=1;
				}else{

					if($post['id_eva']>0){
						$html =  $this->Inicio_model->obtener_cuestionario($post['id_eva']);
						$pass=$this->Inicio_model->get_pass_by_eval($post['id_eva']);
						$time = $this->Inicio_model->get_time_eval($post['id_eva']);
						$data['nombre'] = $post['name'];
						$data['id_user'] = $u;
						$this->session->set_userdata($data);
						$aviso = 0;
					}else{
						$html ="No se encontro inguna evaluacion";
						$respuesta="bad";
						$mensaje="No se encontro inguna evaluacion";
					}
				}
				
				//$mensaje="Suerte!";
				
			}else{
				$mensaje="Error al procesar la información";
				$respuesta="bad";
			}
		  $datajson = array('m' =>$mensaje, 'r' =>$respuesta,'html'=>$html, 't'=>$time, 'a'=>$aviso, 'pw'=> md5($pass));
          echo json_encode($datajson);
		}
	}

	public function nota($v = FALSE){
		//$this->output->enable_profiler(TRUE);
		if($v=== FALSE)
		{
			$post = $this->input->post();
			$data = array();
			if($post){
				$nota = $this->Inicio_model->calificar_evaluacion($post);
				$this->Inicio_model->guardar_datos_eval($post['id_eva'], $nota);
				$data['nota']= $nota;
				$data['eval'] = $this->Inicio_model->get_eval($post['id_eva']);
				//echo  
				$this->load->view('Inicio/head',$data);
				$this->load->view('Inicio/eval/result');
				$this->load->view('Inicio/footer');
			}
		}else{

			$this->session->sess_destroy();
			redirect('inicio','refresh');
		}



	}



}

/* End of file Inicio.php */
/* Location: ./application/controllers/Inicio.php */