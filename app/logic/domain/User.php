<?php
class User {
    private $userId = NULL;
    private $name = NULL;
    private $lastname = NULL;
    private $email = NULL;
    private $typeUser = NULL;

    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function setName($name) {
        $this->name = $name;
    }
    public function setLastname($lastname) {
        $this->lastname = $lastname;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setTypeUser($typeUser) {
        $this->typeUser = $typeUser;
    }
    public function getUserId() {
        return $this->userId;
    }
    public function getName() {
        return $this->name;
    }
    public function getLastname() {
        return $this->lastname;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getTypeUser() {
        return $this->typeUser;
    }

}

?>