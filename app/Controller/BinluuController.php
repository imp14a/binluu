<?php


class BinluuController extends AppController {

    public function terms(){
        $this->set("title_for_layout","Términos y condiciones");
    }

    public function politics(){
        $this->set("title_for_layout","Politicas de uso");
    }

    public function faq(){
        $this->set("title_for_layout","Preguntas frecuentes");
    }
    
    public function about(){
        
    }

}
?>