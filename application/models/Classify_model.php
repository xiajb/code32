<?php
/**
 *
 */
class Classify_model extends Ci_Model
{

  const TBL='ci_classify';  
  function __construct(){
    parent::__construct();

  }
  function Show_classify_byid($direction_id){
    if($direction_id>0){
      $this->db->where('direction_id',$direction_id);
    }
    $query=$this->db->get('ci_classify');

    return $query->result_array();
  }

  public function add_classify($data){
    return $this->db->insert(self::TBL,$data);
  }

  public function query_all(){
    $sql = 'select * from ci_classify';
    $query = $this->db->query($sql);
    return $query->result_array();
  }

  public function delete($id){
    return $this->db->delete(self::TBL, array('classify_id' => $id));
  }

}



 ?>
