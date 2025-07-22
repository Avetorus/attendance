<?php

class Login extends Controller {
    public function index() {
        // $data["title"] = "Home"; 
        // $data["AdminModel"] = $this->model('AdminModel')->getAllAdmins();
        // $this->view('templates/header', $data);
        var_dump($_GET);
        var_dump(empty([]));
        $this->view('login/index');
        // $this->view('templates/footer');
    }

    public function acc() {
        echo "ok";
        exit();
    }
}