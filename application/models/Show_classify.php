<?php
/**
 *
 */
class Show_classify extends Ci_Model
{

  function __construct()
  {
    parent::__construct();
  }
  function Show_classify_byid($direction_id){
    $this->load->database();
    if($direction_id>0){
      $this->db->where('direction_id',$direction_id);
    }
    $query=$this->db->get('ci_classify');

    return $query->result_array();


  }



}



 ?>
