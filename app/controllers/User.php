<?php

class User extends Controller {
    private UserModel $db;
    public function index(){
        $this->db = $this->model('UserModel');
        $data["db"] = $this->db;
        $data["title"] = "User";

        $this->view('templates/header', $data);
        $this->view('user/index', $data);
        $this->view('templates/footer', $data);
    }
}