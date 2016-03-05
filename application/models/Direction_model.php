<?php
/**
 *
 */
class Direction_model extends Ci_Model
{

  function __construct()
  {
    parent::__construct();
  }
  function Show_direction(){
    $this->load->database();
    $query=$this->db->get('ci_direction');
    return $query->result_array();
  }
}




 ?>
