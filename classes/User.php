<?php

include_once (__DIR__ . "/Db.php");

class User{

private $username;
private $email;
private $password;
private $confirmPassword;



          /**
     * Get the value of username
     */ 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set the value of username
     *
     * @return  self
     */ 
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get the value of ConfirmPassword
     */ 
    public function getConfirmPassword()
    {
        return $this->confirmPassword;
    }

    /**
     * Set the value of ConfirmPassword
     *
     * @return  self
     */ 
    public function setConfirmPassword($confirmPassword)
    {
        $this->confirmPassword = $confirmPassword;

        return $this;
    }



    //login functie ----------

    public function canLogin($email,$password)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare('select * from users where email = :email');
        $statement->bindParam(':email', $email);
        $result = $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        $hash = $user['password'];
	
        if(password_verify($password, $hash)){   
            return true; 
        }
        else{
            return false;
        }
    }



    // registreren -------------

    public function registerUser()
    {

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into users (username,email,password) values(:username, :email, :password)");
        $username = $this->getUsername();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $confirmPassword = $this->getConfirmPassword();

        if(empty($email) || empty($username) || empty($password) || empty($confirmPassword)) {
            throw new Exception("Alle velden moeten ingevuld worden");
            return false;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Geef een geldig emailadres");
            return false;

        } elseif($password != $confirmPassword){
            throw new Exception("wachtwoorden komen niet overeen");
            return false;
        }else {

            $hash = password_hash($password, PASSWORD_DEFAULT, ['cost' => 13]);
            $statement->bindValue(":username", $username);
            $statement->bindValue(":email", $email);
            $statement->bindValue(":password", $hash);
            $result = $statement->execute();
            return $result;
        }
        


       


    }


}