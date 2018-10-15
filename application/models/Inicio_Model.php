<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_Model extends CI_Model {

	public function get_post_by_title($titulo){
		 if($titulo !==FALSE){
            $SQL = 'SELECT * FROM `post` WHERE `url_pos`= "'.url_title(url_friend($titulo)).'" limit 1';
            $result =  $this->db->query($SQL);
            if($result && $result->num_rows()>0){
                return $result->row();
            }
        }
        return null;
	}
	
    public function have_content($id_pos){

        $sql = "SELECT `cue_pos`,`img_pos`,`vid_pos` FROM `post` WHERE `id_pos` = ".$id_pos." ";
         $result =  $this->db->query($sql);
        if($result){
             if($result->row()->cue_pos =="0" && $result->row()->img_pos =="" && $result->row()->vid_pos =="")
                return false;
        }
        return true;
    }

    public function get_refer_by_post($id_pos){
        if($id_pos !==FALSE)
        {
            $r = $this->db->get_where('referencias', array('id_pos' => $id_pos));
            return $r; 
        }
        return null;
    }

    public function get_pass_by_eval($id_eva){
     if($id_eva !==FALSE)
            {
                $r = $this->db->get_where('evaluaciones', array('id_eva' => $id_eva),0,1);
                return $r->row()->eva_pwr; 
            }
            return null;
    }
    //

    public function get_eval_by_title($titulo){
        $sql = "SELECT `id_eva`,`eva_tit`,`eva_tim`,eva_des,`eva_url`,`eva_tot`,`eva_sta`, (SELECT COUNT(*) FROM preguntas WHERE id_eva = evaluaciones.id_eva)as num FROM `evaluaciones` WHERE `eva_url`= '".url_title(url_friend($titulo))."' and `eva_sta`= 1 limit 0,1";
         $result =  $this->db->query($sql);
            if($result && $result->num_rows()>0){
                return $result->row();
        }
        return null;
    }

    public function comprobar_usuario($name){
        $sql = "SELECT * FROM `user_nrg` WHERE `nom_nrg` ='".$name."'";
        $result =  $this->db->query($sql);
        if($result && $result->num_rows()>0){
            return $result->row()->id_nrg;
        }

        return -1;
    }

    public function insert_usuario($name){
        if($this->db->query('INSERT INTO `user_nrg`(`nom_nrg`) VALUES ("'.$name.'")')){
            return $this->db->insert_id();
        }
        return -1;
    }

    public function obtener_cuestionario($id_eval){
        $p='';
        $lol='';
        $var ='';
         $eval = $this->db->query('SELECT * FROM `evaluaciones` WHERE `id_eva`="'.$id_eval.'" limit 0,1');
         if($eval->num_rows()>0){
            $preg = $this->db->query('SELECT * FROM `preguntas` WHERE `id_eva`= '.$eval->row()->id_eva.' ');
            if($preg->num_rows()>0){
                $i = 1;
                foreach ($preg->result() as $pre) {
                $p .='
                    <article id="q'.$pre->id_pre.'" class="question">
                    <div class="question-title">            
                        <h3 style="font-size: 20px; font-weight: bold;">'.$i.'.- '.$pre->pre_def.'</h3>
                    </div><ol class="question-answers" type="a">
                ';
                    $j = 0;
                    $lit = $this->db->query("SELECT * FROM `literales` WHERE `id_pre` = ".$pre->id_pre." ");
                    foreach ($lit->result() as $l) {
                        $lol.='
                            <li class="answer">
                                <label for="'.$pre->id_pre.$j.'" class="selectable">
                                    <input type="radio" data-id="'.$pre->id_pre.'" name="results('.$i.')" value="'.$pre->id_pre.';'.$l->lit_vin.'" id="'.$pre->id_pre.$j.'">
                                    <i class="selector"></i>'.$l->lit_cue.'</label>
                            </li>';
                        $j++;
                    }

                    $var .= $p.$lol.'</ol></article> ';
                    $p='';
                    $lol='';
                    $i++;
                }
                return $var;
            }
         }
        
        return "";

    }

    public function rindio_prueba($id_user, $id_eva){
        
        $sql = "SELECT `id_eva`, `id_nrg`FROM `user_eval` WHERE `id_nrg` = ".$id_user." and id_eva= ".$id_eva." ";
        if($this->db->query($sql)->num_rows()>0){
            return true;
        }

        return false;
    }

    public function comprobar_pre_rsp($pre, $resp){
         $sql = "SELECT `pre_rsp` FROM `preguntas` WHERE `id_pre`= ".$pre." ";
         $rsp = $this->db->query($sql)->row();
        if($rsp->pre_rsp == $resp){
            return true;
        }

        return false;
    }
    public function numero_preg_eval($id_eva){
        $sql = "SELECT COUNT(*)as num FROM preguntas WHERE id_eva = ".$id_eva." ";
        return $this->db->query($sql)->row()->num;
    }

    public function get_promedio_eva($id_eva){
        $sql = "SELECT `eva_tot` FROM `evaluaciones` WHERE `id_eva` = ".$id_eva." ";
        $r = $this->db->query($sql)->row();
        if($r)
        return $r->eva_tot;
    }

    public function get_time_eval($id_eva){
        $sql = "SELECT (TIME_TO_SEC(`eva_tim`)DIV 60) min FROM evaluaciones WHERE `id_eva` = ".$id_eva." ";
        $r = $this->db->query($sql)->row();
        if($r)
            return $r->min;
    }

    public function get_eval($id_eva){
        $r = $this->db->query('Select * from evaluaciones where id_eva ='.$id_eva);
        if($r->num_rows()>0){
            return $r->row();
        }
        return null;
    }

    public function guardar_datos_eval($id_eval, $nota){
        $data = array('id_nrg' =>$this->session->userdata('id_user'),'id_eva'=>$id_eval, 'nota'=>$nota);
        
        $r = $this->db->query("UPDATE `user_nrg` SET `num_eval`= `num_eval`+1, `not_tot`= (`not_tot`+ ".$nota." )/ `num_eval` WHERE `id_nrg` = ".$this->session->userdata('id_user')." ");

        if($this->db->insert('user_eval', $data) && $r){
            return true;
        }

    }

    public function calificar_evaluacion($post=FALSE){
        if($post!==FALSE){
            $pro = $this->get_promedio_eva($post['id_eva']);
            $num_pre = $this->numero_preg_eval($post['id_eva']);
            $totxpre = $pro/$num_pre;
            $nota = 0;
            for ($i=1; $i <count($post) ; $i++) { 
                if(isset($post['results('.$i.')'])){
                    $r = preg_split('/;/',$post['results('.$i.')']);
                    if($r[0]!='' && $r[1]!=''){
                        if($this->comprobar_pre_rsp($r[0], $r[1])){
                          $nota = $nota + $totxpre;
                        }else{
                         $nota = $nota +0;
                        }
                    }
                }
            }
        }
        return $nota;
    }
}

/* End of file Inicio_Model.php */
/* Location: ./application/models/Inicio_Model.php */