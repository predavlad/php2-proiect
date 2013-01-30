<?php

class Admin_Controller_Index extends Core_Controller_Core {


    public function indexAction() {
        $user = Core::getModel('core/user')->getCurrentUser();

        if (!is_null($user)) {
            if ($user->isAdmin()) {
                // user is logged in, and admin. Proceed
            } else {
                // user does not have permissions to access this
                // should do something about it :)
            }
        } else {

            if (isset($_POST['user'])) {
                $user = Core::getModel('core/user');
                if ($userId = $user->checkLogin($_POST['user'], $_POST['pass'])) {
                    $user->setUser($userId);
                    $user->setUserSession($userId);
                    Core::redirect('admin/product');
                }

            }

            $user = new Form_Input_Text('user');
            $pass = new Form_Input_Password('pass');

            $form = new Form;
            $form->setSubmit(array('label' => 'Log in'));
            try {
                $form->addInput($user, 'Username');
                $form->addInput($pass, 'Password');
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            $this->assign('form', $form);

            // show login form and remove all the unnecessary stuff
            // maybe not the best way to do it - but HEY !!! It works
            $this->setTemplate('1col-main');
            $this->setAreaTemplate('header', '');
            $this->setAreaTemplate('footer', '');
            $this->setAreaTemplate('left', '');
            $this->render(true);
        }

    }


}