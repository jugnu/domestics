<?php

class AuthenticationController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {
        // action body
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
//        loginAction();
        $this->_redirect('/');
    }

    public function loginAction() {
        
        $this->view->title = 'Login';
        if (Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('/');
        }
        $form = new Form_loginform();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
                $authAdapter = $this->getAuthAdapter();
                $username = $form->getValue('username');
                $password = $form->getValue('password');
                $authAdapter->setIdentity($username)
                        ->setCredential($password);

                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);

                if ($result->isValid()) {
                    $identity = $authAdapter->getResultRowObject();

                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    $this->_redirect("/");
                } else {
                    $this->view->errorMessage = 'user name or password is wrong';
                }
            }
        }

        $this->view->form = $form;
    }

    private function getAuthAdapter() {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('users')
                ->setIdentityColumn('username')
                ->setCredentialColumn('password');
        return $authAdapter;
    }

}

