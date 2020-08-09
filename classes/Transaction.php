<?php

include_once (__DIR__ . "/Db.php");


class Transaction{

    
    private $id;
    private $bedrag;
    private $description;
    private $datum;
    private $user_ontvanger;
    private $user_verzender;

    private $username;
    private $email;
    private $password;
    private $confirmPassword;
    private $tokens;


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
     * Get the value of bedrag
     */ 
    public function getBedrag()
    {
        return $this->bedrag;
    }

    /**
     * Set the value of bedrag
     *
     * @return  self
     */ 
    public function setBedrag($bedrag)
    {

        if ($bedrag < 1 )
          {
            throw new Exception ("Het bedrag moet minstens 1 zijn");
          }
        $this->bedrag = $bedrag;

        return $this;
    }

    /**
     * Get the value of description
     */ 
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set the value of description
     *
     * @return  self
     */ 
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

        /**
     * Get the value of datum
     */ 
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set the value of datum
     *
     * @return  self
     */ 
    public function setDatum($datum)
    {
        $this->datum = $datum;

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




    //----------GETTERS EN SETTERS






    public function saveTransfer(){

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (id,bedrag, description, datum, user_verzender, user_ontvanger) values (:id, :bedrag, :description, :datum, :usersender, :userontvanger)");
        $id = $this->getId();
        $bedrag = $this->getBedrag();
        $description = $this->getDescription();
        $datum = $this->getDatum();
        $ontvanger = $this->getUser_ontvanger();



        if(empty($bedrag) || empty($description) ){
            throw new Exception("Alle velden moeten ingevuld worden");
            return false;
        }
            else {
            $statement->bindValue(":id", $id);
            $statement->bindValue(":bedrag", $bedrag);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":datum", $datum);
            $statement->bindValue(":usersender", $_SESSION["userid"]);
            $statement->bindValue(":userontvanger", $ontvanger);

            $result = $statement->execute();
            return $result;
    
            }

        }       


    // get bedrag

        public static function getAll($bedrag){
        $conn = Db::getConnection();
        $statement = $conn->prepare('select $ from transfers where bedrag = :bedrag');
        $statement->bindValue(':bedrag', $bedrag);

        $result = $statement-execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }

    
         // get user by name-------------

         public function getUserUsername($username)
         {
           $conn = Db::getConnection();
           $statement = $conn->prepare("select * from users where username = :username");
           $username = $username;
           $statement->bindValue(':username', $email);
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




        //get all transfers
    
        public function getTransfers(){

        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from transfers where user_verzender =:id or user_ontvanger =:id");
        $statement->bindValue(":id", $_SESSION['userid']);
        $result = $statement->execute();
        $transfer = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $transfer;
    }


    
    //check tokens

    
        public function checkTokens($tokens)
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("select * from users where tokens = :tokens");

        //$beschrikbaar=("select * from users where tokens = :tokens");
        //if ($beschrikbaar < 0){
 
        //throw new Exception("Je hebt niet voldoende tokens");
       //return false;
        //} else {

        $statement->bindValue(':tokens', $tokens);
        $result = $statement->execute();
        return $result;

        }



     public static function transactiesVerzender()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users INNER JOIN transfers ON users.id = transfers.user_verzender");

        $statement->bindValue(":id", $_SESSION['userid']);
        $statement->execute();
        $transactieVerzender = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $transactieVerzender;
    }

    public static function transactiesOntvanger()
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare("SELECT * FROM users INNER JOIN transfers ON users.id = transfers.user_ontvanger");

        $statement->bindValue(":id", $_SESSION['userid']);
        $statement->execute();
        $transactieOntvanger = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $transactieOntvanger;
    }


    /*
    public static function findUser()
    {
        $conn = Db::getConnection();
        $statement1 = $conn->prepare("SELECT username FROM users WHERE id = :verzender");

        $verzender = $_SESSION['verzender'];

        $statement1->bindValue(":verzender", $verzender);

        $user = $statement1->execute();

        return $user;
    }
    */

}