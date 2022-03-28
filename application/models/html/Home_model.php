<?php defined('BASEPATH') or exit('No direct script access allowed');
class Home_model extends CI_Model
{
    public $result_arr;
    protected $table_name = "";

    public function __construct()
    {
        parent::__construct();        
        $this->load->database(); 
        $this->result_val = array('code' => 0, 'msg' => '发生错误');
        $this->conn = $this->load->database('181304034llq_db', true);
    }

    /* 
    *查询数据
     */
    public function selectDB($select_content, $select_where = array(), $select_tb, $select_row = true)
    {
        $data = $this->db->select($select_content);
        $query = $this->db->from($select_tb)
            ->where($select_where)
            ->get();
        if ($select_row) {
            $data = $query->row_array();
        } else {
            $data = $query->result_array();
        }
        if ($data) {
            $result = $this->set_reuslt_msg(true, '查询成功');
            $result['data'] = $data;
        } else {
            $result =  $this->set_reuslt_msg(false, '查询失败');
            $result['data'] = $data;
        }
        return $result;
    }

    /* 
    *插入数据
    */
    public function insertDB($insert_tb, $insert_data)
    {
        $data = $this->db->insert($insert_tb, $insert_data);
        $affected_rows = $this->db->affected_rows();

        if ($affected_rows > 0) {
            $result = $this->set_reuslt_msg(true, '插入成功');
            $result['code'] = 1;
            $result['id'] = $this->db->insert_id($data);
            $result['data'] = $data;
        } else {
            $result['code'] = 0;
            $result = $this->set_reuslt_msg(false, '插入失败');
        }
        return $result;
    }

    /* 
    *更新数据
     */
    public function updateDB($update_tb, $update_data = array(), $id)
  {
    $this->db->where('id', $id)
      ->update($update_tb, $update_data);
    // echo $this->db->last_query();
    $affected_rows = $this->db->affected_rows();
    if ($affected_rows > 0) {
        return $this->set_reuslt_msg(true, '插入成功');
    } else {
        return $this->set_reuslt_msg(false, '插入失败');
    }
  }

    /* 
    * 删除单条数据
    */
    public function deleteDB($delete_tb, $id)
    {
      $this->db->set('is_delete', '1')
        ->where('id', $id)
        ->update($delete_tb);
      /* echo $this->db->last_query();
        exit; */
      $affected_rows = $this->db->affected_rows();
      if ($affected_rows > 0) {
        return $this->set_reuslt_msg(true, '删除成功');
      } else {
        return $this->set_reuslt_msg(false, '删除失败');
      }
    }
  
    /* 
    * 删除多条数据
    */
    public function deleteDB2($delete_tb = 'user', $ids)
    {
      $this->db->set('is_delete', '1')
        ->where_in('id', $ids)
        ->update($delete_tb);
      $affected_rows = $this->db->affected_rows();
      if ($affected_rows > 0) {
        return $this->set_reuslt_msg(true, '删除成功');
      } else {
        return $this->set_reuslt_msg(false, '删除失败');
      }
    }
  

    /* 
    *返回操作结果
     */    
    public function set_reuslt_msg($result_state = true, $msg = '')
    {
        if ($result_state) {
            $result['code'] = 1;
            $result['msg'] = $msg;
        } else {
            $result['code'] = 0;
            $result['msg'] = $msg;
        }
        return $result;
    }
}