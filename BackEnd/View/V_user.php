<?php
class V_User {
    public function Controller() {
        require_once "BackEnd/Controller/C_user.php";
        $controller = new C_user();
        return $controller;
    }
    public function action($act) {
        if (!isset($_SESSION['userid']) && $act === "") {
            $act = "dangnhap";
            include "Frontend/view/dangnhap.php";
        } else if ($act === "dangxuat") {
            $this->Controller()->logout();
        }
        else if ($act === "login") {
            $this->Controller()->login();
        } else if ($act === "update_profile") {
            $this->Controller()->update();
        } else if ($act === "dangky") {
            $this->Controller()->signin();
        } else if ($act === "follow") {
            $this->Controller()->TheoDoi();
        } else if ($act === "email") {
            $this->Controller()->Email();
        } else if ($act === "Vcode") {
            $this->Controller()->XacMinh();
        } else if ($act === "newpass") {
            $this->Controller()->Matkhaumoi();
        }
        
        
    }
}
?>