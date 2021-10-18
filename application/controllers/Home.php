<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    if ($this->session->admin) redirect('admin/dashboard');
    if ($this->session->pj) redirect('penanggung_jawab/dashboard');
    $this->load->model('MoUser_model', 'muser');
  }

  public function index()
  {
    $this->load->view('vlogin');
  }
  public function checkLog() {
    if (@$this->input->post('loginBtn')) {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      // $this->muser->where();
      $this->db->where([
          'user_email' => $email,
      ]);
      $result = $this->muser->get();
      $this->_checkLog($result, $password);
    } else {
      redirect(site_url());
    }
  }

  private function _checkLog($result, $password) {
    $error = false;
    $message = '';
    if ($result->num_rows() > 0) {
      if ($result->row()->password != md5($password)) {
        $error = true;
        $message = 'Passwors Salah!';
      } else {
        switch ($result->row()->akses) {
          case '1':
            $this->muser->setLastLogin($result->row()->user_id);
            $this->session->set_userdata('admin', $result->row());
            break;
          case '2':
            $this->muser->setLastLogin($result->row()->user_id);
            $this->session->set_userdata('penanggung_jawab', $result->row());
            break;
          default:
            $error = true;
            $message = 'Hak Akses Tidak di temukan';
            break;
        }
      }
    } else {
      $error = true;
      $message = 'user Tidak di temukan';
    }

    if ($error) {
      $this->session->set_flashdata('error', $message);
    }
    redirect(site_url());
    
  }
}