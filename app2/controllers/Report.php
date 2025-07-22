<?php

class Report extends Controller {
    public function index(){
        $data["title"] = "Report";
        $this->view('templates/header', $data);
        $this->view('report/index', $data);
        $this->view('templates/footer');
    }
}