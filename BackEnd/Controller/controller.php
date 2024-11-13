<?php
class Controller {

    // Hàm khởi tạo Controller
    public function View() {
        require_once "BackEnd/View/view.php";
        $view = new View(); // Tạo đối tượng View
        return $view;
    }
    public function userC() {
        require_once "BackEnd/Controller/C_user.php";
        $userC = new C_user();
        return $userC;
    }
    // Phương thức để thực hiện hành động
    public function action() {
        $act = isset($_GET['action']) ? $_GET['action'] : '';
        return $act;
    }
    
}   
?>