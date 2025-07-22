<?php

class Login extends Controller {

    private AdminModel $db;
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
        $this->db = $this->model('AdminModel');
        print_r($_POST);
        $email = $_POST['email']; 
        $pwd = $_POST['pwd'];      

        if (empty($email) || empty($pwd) ) {
            header("location: login?error=emptyfields");
            $this->db->close();
            exit();
        }else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("location: login?error=invalidEmail");
            $this->db->close();
            exit();
        }else{
            $sql = "SELECT * FROM admin WHERE admin_email=?";
            if (!$this->db->query($sql)) {
                $this->db->close();
                header("location: login?error=sqlerror");
                exit();
            }else{
                $this->db->bind('s', $email);
                $this->db->execute();
                
                if($row = $this->db->single()){
                    $checkPwd = password_verify($pwd, $row['admin_pwd']);

                    if(!$checkPwd){
                        header("location: login?error=wrongpassword");
                        $this->db->close();
  					    exit();
                    }else{
                        session_start();
                        $_SESSION['Admin-name'] = $row['admin_name'];
                        $_SESSION['Admin-email'] = $row['admin_email'];
                        header("location: .");
                        $this->db->close();
                        exit();
                    }
                }else{
                    header("location: login?error=noUser");
                    $this->db->close();
  				    exit();
                }
            }
        }
    }
}