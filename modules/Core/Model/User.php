<?php

class Core_Model_User extends Core_Model_Core {

    protected $isAdmin;


    /**
     * @return null
     */
    public function getCurrentUser() {
        if ($id = intval($_SESSION['id'])) {
            return $this->getUser($id, true);
        }
        return null;
    }

    /**
     * @param null $id
     * @param bool $force
     * @return Core_Model_User
     * @throws Exception
     */
    public function getUser($id = null, $force = false) {

        // prevent accessing the database if the user is load, or if we really really want to re-load
        if ($this->isLoaded && !$force) {
            return $this;
        }

        $this->setUser($id);

        if (is_null($id) || !intval($id)) {
            $id = intval($_REQUEST['id']);
            if (!$id) {
                $up = new Exception('Something went wrong');
                throw $up; // ha ha
            }
        }
        return $this;
    }

    /**
     * Set the user. Maybe this should be protected or private.
     * Ah well, who the hell will bother to re-use this crappy code :))
     *
     * @param $id
     * @return mixed
     */
    public function setUser($id) {
        $db = DB::table('users');
        $db->where("id = {$id}");
        $user = $db->fetchRow();
        foreach ($user as $key => $value) {
            if (!is_int($key)) {
                $this->$key = $value; // so we will set the password in the user object, not a big deal
            }
        }

        // set some other stuff
        $this->isLoaded = true;
        $this->isAdmin = (bool)$user['is_admin'];


        // come to think of it ... maybe I should comment this code better
        // who knows ... some day some one might use it !!!
        $db->reset();
        return $user;
    }

    public function setUserSession($user) {

        if ($user instanceof Core_Model_User) {
            $_SESSION['user'] = $user;
        } else if(intval($user)) {

            $_SESSION['user'] = $this->getUser(intval($user));
        }
        return $this;
    }




    public function isAdmin() {
        return $this->isAdmin;
    }

    /**
     * If my ORM would be using prepared statements, my query would be safe.
     * At least there is a single point of failure :) (the database class)
     * @param $user
     * @param $pass
     */
    public function checkLogin($user, $pass) {
        $db = DB::table('users');
        $db->where("user = '" . mysql_real_escape_string($user) . "'"); // this wouldn't be necessary if I used prepared statements
        $db->where("pass = '" . $this->encryptPassword($pass) . "'");
        $user = $db->fetchRow();
        return $user['id']; // false or the user id
    }
    /**
     * @TODO: encrypt password
     * so it will be HASHED_PASS:SALT
     * and encryption mechanism in php should be something like:
     * for ($i = 1; $i <= 20; $i ++) {
     *     $pass = sha1(md5($pass . $salt) . $salt);
     * } replace sha1 and md5 with more suited algorithms like blowfish
     */
    public function encryptPassword($pass) {
        return $pass;
    }

}