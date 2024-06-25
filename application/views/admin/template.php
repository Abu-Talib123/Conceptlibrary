<?php 
$this->load->view('admin/top');
$this->load->view('admin/header');
$this->load->view('admin/leftsidebar');
$this->load->view('admin/breadcrumb.php');
$this->load->view($load_view);
//$this->load->view('admin/rightsidebar');
$this->load->view('admin/footer');
$this->load->view('admin/bottom');
?>