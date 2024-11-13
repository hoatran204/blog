<?php
class V_admin {
    public function Controller() {
        require_once "BackEnd/Controller/C_admin.php";
        $controller = new C_admin();
        return $controller;
    }
    public function action($act) {
        if ($act === "admin") {
            include "FrontEnd/admin/ql_baiviet.php";
        } else if ($act === "logoutfromadmin") {
            $this->Controller()->logout();
        } else if ($act === "adDP") {
            $this->Controller()->deletepost();
        } else if ($act === "qlbinhluan") {
            include "FrontEnd/admin/ql_binhluan.php";
        } else if ($act === "qlnguoidung") {
            include "FrontEnd/admin/ql_nguoidung.php";
        } else if ($act === "adDC") {
            $this->Controller()->deletecmt();
        } else if ($act === "adDU") {
            $this->Controller()->deleteuser();
        }
        
        
    }
}
?>