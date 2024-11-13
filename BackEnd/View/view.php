<?php 
class View {
    public function Controller() {
        require_once "BackEnd/Controller/controller.php";
        $controller = new Controller();
        return $controller;
    }
    public function userview() {
        require_once "BackEnd/View/V_user.php";
        $viewuser = new V_User();
        return $viewuser;
    }
    public function adminview() {
        require_once "BackEnd/View/V_admin.php";
        $viewadmin = new V_admin();
        return $viewadmin;
    }
    public function Render($page) {
        include "Frontend/view/header.php";
        include $page;
        include "Frontend/view/footer.php";
    }
    public function postview() {
        require_once "BackEnd/View/V_post.php";
        $viewpost = new V_post();
        return $viewpost;
    }
    public function action() {
        $act = $this->Controller()->action();
        $user_actions = ["", "Vcode", "follow", "email", "dangxuat", "login", "update_profile", "dangky", "newpass"];
        $post_actions = ["posting", "liked", "shared", "cmt", "likecmt", "phanhoi"];
        $admin_actions = ["admin", "logoutfromadmin", "adDP", "adDC", "adDU", "qlbinhluan", "qlnguoidung"];
        if ($act === "" and isset($_SESSION['userid'])) {
            $this->render("Frontend/view/trangchu.php");
        } elseif ($act === "dangnhap") {
            include "Frontend/view/dangnhap.php";
        } elseif (in_array($act, $user_actions)) {
            $this->userview()->action($act);
        } elseif (in_array($act, $post_actions)) {
            $this->postview()->action($act);
        } elseif (in_array($act, $admin_actions)) {
            $this->adminview()->action($act);
        } else {
            $this->render("Frontend/view/{$act}.php"); 
        }
    }
}
?>