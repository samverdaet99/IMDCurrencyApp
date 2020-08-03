<?php

include_once (__DIR__ . "/Db.php");


class Transfers {

    private $bedrag;
    private $description;
    private $user_ontvanger;
    private $user_verzender;

// -------------------- GETTERS EN SETTERS  ---------------------------


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


   


    //-----------Functions 




    public function saveTransfers(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (bedrag, description, user_ontvanger, user_verzender)values (:bedrag, :description, :user_ontvanger, :user_verzender) ");
        
        $bedrag = $this->getBedrag();
        $description = $this->getDescription();
        $user_ontvanger = $this->getUser_ontvanger();
        $user_verzender = $this->getUser_verzender();

        if(empty($bedrag) || empty($description)) {
            throw new Exception("Alle velden moeten ingevuld worden");
            return false;
        }            
            else {

        $statement->bindValue(":bedrag", $bedrag);
        $statement->bindValue(":description", $description);
        $statement->bindValue(":user_verzender", $user_verzender);
        $statement->bindValue(":user_ontvanger", $user_ontvanger);
        

        $result = $statement->execute();
        return $result;

            }
    }


    public static function getAll($bedrag){
        $conn = Db::getConnection();
        $statement = $conn->prepare('select $ from transfers where bedrag = :bedrag');
        $statement->bindValue(':bedrag', $bedrag);

        $result = $statement-execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }



        




    }




        

    


    



