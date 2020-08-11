<?php

include_once (__DIR__ . "/Db.php");

class User{

private $id;
private $username;
private $email;
private $password;
private $confirmPassword;
private $tokens;

//alle transfers
private $user_ontvanger;
private $user_verzender;
private $transfer_id;








// -------------------- GETTERS EN SETTERS  ---------------------------


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
        $emailCheck = strrpos($email, "@student.thomasmore.be");
    
        if (empty ($email)){
            throw new Exception ("Gelieve je email in te voeren.");
        }

        if ($emailCheck === false) { 
            throw new Exception ("Vul een geldig email adress in");
        }


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

       
         if(strlen(trim($password)) < 5)
          {
            throw new Exception ("Het wachtwoord moet minstens uit 5 tekens bestaan.");
          }
        
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

        /**
    * Get the value of tokens
    */ 
    public function getTokens()
    {
    return $this->tokens;
    }

    /**
    * Set the value of tokens
    *
    * @return  self
    */ 
    public function setTokens($tokens)
    {


        $this->tokens = $tokens;
        return $this;
    

    }

    /**
     * Get the value of id
    */ 
    public function getId()
    {
    return $this->id;
    }

    /**
    * Set the value of id
    *
    * @return  self
    */ 
    public function setId($id)
    {
    $this->id = $id;

    return $this;
    }



    /**
     * Get the value of user_ontvanger
     */ 
    public function getUser_ontvanger()
    {
        return $this->user_ontvanger;
    }

    /**
     * Set the value of user_ontvanger
     *
     * @return  self
     */ 
    public function setUser_ontvanger($user_ontvanger)
    {
        $this->user_ontvanger = $user_ontvanger;

        return $this;
    }

    /**
     * Get the value of user_verzender
     */ 
    public function getUser_verzender()
    {
        return $this->user_verzender;
    }

    /**
     * Set the value of user_verzender
     *
     * @return  self
     */ 
    public function setUser_verzender($user_verzender)
    {
        $this->user_verzender = $user_verzender;

        return $this;
    }

    /**
     * Get the value of transfer_id
     */ 
    public function getTransfer_id()
    {
        return $this->transfer_id;
    }

    /**
     * Set the value of transfer_id
     *
     * @return  self
     */ 
    public function setTransfer_id($transfer_id)
    {
        $this->transfer_id = $transfer_id;

        return $this;
    }




    // -------------------- FUNCTIONS ---------------------------



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
        $statement = $conn->prepare("insert into users (username,email,password,tokens) values(:username, :email, :password, '10' )");
        $username = $this->getUsername();
        $email = $this->getEmail();
        $password = $this->getPassword();
        $confirmPassword = $this->getConfirmPassword();
        $tokens = $this->getTokens();
        
 
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

    // get user -------------

    public function getUser($id)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from users where id = :id");
        $id = $id;
        $statement->bindValue(':id', $id);
        $result = $statement->execute();
        $user = $statement->fetch(PDO::FETCH_ASSOC);
        return $user;
    }




     // get user by email-------------

    public function getUserByEmail($email)
    {
      $conn = Db::getConnection();
      $statement = $conn->prepare("select * from users where email = :email");
      $email = $email;
      $statement->bindValue(':email', $email);
      $result = $statement->execute();
      $user = $statement->fetch(PDO::FETCH_ASSOC);
      return $user;
  
    }










    

           





}


