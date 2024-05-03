<?php
class Account {
    private $userId = NULL;
    private $user = NULL;
    private $password = NULL;

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function getUserId() {
        return $this->userId;
    }

    public function getUser() {
        return $this->user;
    }

    public function getPassword() {
        return $this->password;
    }
}

?>