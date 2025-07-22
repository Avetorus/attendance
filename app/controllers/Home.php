<?php

class Home extends Controller {
    public function index() {
        $data["title"] = "Home"; 
        $data["admin"] = $this->model('AdminModel')->getAdminByEmail("admin@gmail.com");
        $data["allAdmin"] = $this->model('AdminModel')->getAllAdmins();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}