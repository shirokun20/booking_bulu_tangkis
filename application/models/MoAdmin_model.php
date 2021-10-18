<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MoUser_model extends CI_Model {

  private $tabel='user';

  public function get($where = null) {
    if ($where) $this->db->where($where);
    return $this->db->get($this->tabel);
  }

  public function hapusData($id) {
    $check = $this->db
      ->where('id_admin', $id)
      ->delete('admin');
    return $check;
  }

  public function tambahData($data) {
    if ($this->db->insert($this->tabel, $data)) {
      return [
        'status' => 'berhasil',
        'insert_id' => $this->db->insert_id(),
      ];
    } else {
      return [
        'status' => 'gagal',
      ];
    }
  }

  public function editData($id, $data) {
   if ($this->db->where('id_admin', $id)->update($this->tabel, $data)) {
      return [
        'status' => 'berhasil',
      ];
    } else {
      return [
        'status' => 'gagal',
      ];
    } 
  }

  public function getUser() {
    return $this->db->get($this->tabel);
  }  
}

/* End of file MoUser_model.php */
/* Location: ./application/models/MoUser_model.php */