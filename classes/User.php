<?php

include_once (__DIR__ . "/Db.php");

class User{

private $id;
private $username;
private $email;
private $password;
private $confirmPassword;
private $tokens;






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



// tokens 

    public function checkTokens($tokens)
    {
        $conn = Db::getConnection();
        $balance = $conn->prepare("SELECT * FROM users WHERE (tokens = :tokens)" );
        $tokens = $tokens;
        $statement->bindValue(':tokens', $tokens);
        $result = $statement->execute();
        $tokens = $statement->fetch(PDO::FETCH_ASSOC);
        return $tokens; 

        //if ($balance < 0){
            //throw new Exception("Je hebt niet voldoende tokens");
            //return false;
        //}
            //else {
            //$result = $statement->execute();
            //return $result;

        //




}


}