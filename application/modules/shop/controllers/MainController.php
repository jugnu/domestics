<?php

class Shop_MainController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {

//        if($this->request-isPodt()){
//            echo "posted";
    }

    public function itemsAction() {

        $itemsTBL = new Shop_Model_DbTable_Products();
        $this->view->products = $itemsTBL->fetchAll();
    }

}

//    public function testAction() {
//        // action body
//        
//    }





