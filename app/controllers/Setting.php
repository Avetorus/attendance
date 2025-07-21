<?php

class Setting extends Controller {
    public function index(){
        $data["title"] = "Setting";
        $this->view('templates/header', $data);
        $this->view('setting/index', $data);
        $this->view('templates/footer');
    }
}