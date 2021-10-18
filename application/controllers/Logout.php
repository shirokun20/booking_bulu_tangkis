<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends CI_Controller
{
  public function index()
  {
    $this->session->sess_destroy();
    redirect(site_url());   
  }

}


/* End of file Logout.php */
/* Location: ./application/controllers/Logout.php */