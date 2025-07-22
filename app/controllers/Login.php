<?php

class Login extends Controller {
    public function index() {
        $data["title"] = "Home"; 
        $data["AdminModel"] = $this->model('AdminModel')->getAllUsers();
        // $this->view('templates/header', $data);
        $this->view('login/index', $data);
        // $this->view('templates/footer');
    }

    public function acc() {
        echo "ok";
        exit();
    }
}