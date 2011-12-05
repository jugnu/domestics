<?php

class Model_ShopAcl extends Zend_Acl {

    public function __construct() {
        $this->addRole(new Zend_Acl_Role('guests'));
        $this->addRole(new Zend_Acl_Role('users'),'guests');
        $this->addRole(new Zend_Acl_Role('admins'),'users');
        
        $this->add(new Zend_Acl_Resource('shop'))
                ->add(new Zend_Acl_Resource('shop:main'),'shop');
        
        $this->add(new Zend_Acl_Resource('admin'))
                ->add(new Zend_Acl_Resource('admin:category'),'admin');
        
        $this->add(new Zend_Acl_Resource('default'))
                ->add(new Zend_Acl_Resource('default:authentication'),'default')
                ->add(new Zend_Acl_Resource('default:index'),'default')
                ->add(new Zend_Acl_Resource('default:error'),'default');
        
        $this->allow('guests','default:authentication','login');
        $this->allow('guests','default:error','error');
        
        $this->deny('users','default:authentication','login');
        $this->allow('users','default:authentication','logout');
        $this->allow('users','default:index','index');
        $this->allow('users','shop:main',array('index','items'));
        
        $this->allow('admins','admin:category',array('index','list','update','add'));
        
        
        
    }

}

?>
