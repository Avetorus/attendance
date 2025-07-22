<?php

class AdminModel {
    private $table = 'admin';
    private $db;
    
    public function  __construct() {
        $this->db = new Database();
    }

    public function getAllAdmins(){
        $this->db->query("SELECT * FROM $this->table");
        return $this->db->resultSet();
    }

    public function getAdminByEmail($email) {
        $this->db->query("SELECT * FROM $this->table WHERE admin_email = ?");
        $this->db->bind("s", $email);
        return $this->db->single();
    }
}