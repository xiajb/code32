<?php

/**
 *
 */
class Section_model extends CI_Model
{

  function __construct()
  {
    parent::__construct();
  }

function add_section($in_data){
  $this->load->database();
  $a=$this->db->insert('ci_section',$in_data);
  return $a;
 
}

}






?>
