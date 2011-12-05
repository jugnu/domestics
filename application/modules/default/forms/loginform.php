<?php

class Form_loginform extends Zend_Form {

    public function __construct($options = null) {
        parent::__construct($options);

        $this->setName("Login");

        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('user name:')
                ->setRequired();

        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('password')
                ->setRequired(TRUE);

        $login = new Zend_Form_Element_Submit('submit');
        $login->setLabel('login');
        
        $this->addElements(array($username,$password,$login));
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/login');
    }

}

?>
