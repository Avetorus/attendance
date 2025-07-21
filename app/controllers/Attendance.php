<?php

class Attendance extends Controller {
    public function index(){
        $data["title"] = "Attandance";
        $this->view('templates/header', $data);
        $this->view('attendance/index', $data);
        $this->view('templates/footer');
    }
}