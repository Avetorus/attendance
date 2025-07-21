<?php

class Home extends Controller {
    public function index() {
        $data["title"] = "Home"; 
        $data["UserModel"] = $this->model('UserModel')->getAllUsers();
        $this->view('templates/header', $data);
        $this->view('home/index', $data);
        $this->view('templates/footer');
    }
}