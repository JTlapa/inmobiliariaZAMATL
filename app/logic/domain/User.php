<?php
class User {
    private $userId = NULL;
    private $usuariio = NULL;
    private $password = NULL;
    private $typeUser = NULL;

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setTypeUser($typeUser) {
        $this->typeUser = $typeUser;
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

    public function getTypeUser() {
        return $this->typeUser;
    }
}

?>