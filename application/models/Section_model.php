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
  return $this->db->insert_id();
 // return $a;


}
function add_chapter($in_data){
  $this->load->database();
  $this->db->insert('ci_chapter',$in_data);
  return $this->db->insert_id();
}



}






?>
