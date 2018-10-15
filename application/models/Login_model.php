<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
		
	}

	public function get_user_by_name($post =FALSE){
		if($post !== FALSE){
			$SQL ="Select nom_use, ape_use, id_use, img_user from usuarios where user = ".$this->db->escape($post['username'])." or ema_use = ".$this->db->escape($post['username'])." limit 0,1 ";
			 if($result = $this->db->query($SQL)){
			 	return $result->row();
			 }else{
			 	return array();
			 }
		}
	}
	
	public function get_pass_by_user($id_usuario = FALSE, $pw = FALSE){
		if($id_usuario!== FALSE){
			$result = $this->db->get_where('usuarios', array('id_use' => $id_usuario, 'pass'=>md5($pw)), 0, 1);
			if($result->num_rows()>0){
				return true;
			}else{
				return false;
			}
		}
		return false;
	}

	public function change_pass($id_usuario = FALSE , $pw = FALSE){
		if($id_usuario !== FALSE && $pw !==FALSE)
		{	
			$r = $this->db->update('usuarios', array('pass'=> md5($pw)), array('id_use' => $id_usuario));
			
		        if($r)
		            return true;
		        else
		            return false;
		}
		return false;

	}
}

/* End of file login_model.php */
/* Location: ./application/models/login_model.php */