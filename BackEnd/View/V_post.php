<?php
class V_post {
    public function Controller() {
        require_once "BackEnd/Controller/C_post.php";
        $controller = new C_post();
        return $controller;
    }
    public function action($act) {
        if ($act === "posting") {
            $this->Controller()->posting();
        } else if ($act === "liked") {
            $this->Controller()->liked();
        } else if ($act === "shared") {
            $this->Controller()->Shared();
        } else if ($act === "cmt") {
            $this->Controller()->postcmt();
        } else if ($act === "likecmt") {
            $this->Controller()->likecmt();
        } else if ($act === "phanhoi") {
            $this->Controller()->phanhoi();
        }
        
        
    }
}
?>