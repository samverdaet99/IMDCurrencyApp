<?php

include_once (__DIR__ . "/Db.php");


class Transfers {

    private $bedrag;
    private $description;

	
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



   





    //-----------Functions 

    public function makeTransfer($bedrag=0,$description=0)
    {

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (bedrag,description,user_ontvanger) values(:bedrag, :description, :user_ontvanger)");
        $bedrag = $this->getBedrag();
        $description = $this->getDescription();
        $transfers = $statement->fetch(PDO::FETCH_ASSOC);
        

        if(empty($bedrag) || empty($description) || empty($user_ontvanger)) {
            throw new Exception("Alle velden moeten ingevuld worden");
            return false;

        }  else if (empty($bedrag) > ($tokens)) {
                throw new Exception("Je hebt niet voldoende tokens");
                return false;
    
            } 
            
            else {

            $statement->bindValue(":bedrag", $bedrag);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":user_ontvanger", $user_ontvanger);
            $result = $statement->execute();
            return $result;

            
        


            
        }
    }

        //niet groter dan huidig bedrag functie ----------

        public function tokensCheck($tokens)
        {
            $conn = Db::getConnection();
            $statement = $conn->prepare('select * from users where tokens = :tokens');
            $statement->bindParam(':tokens', $tokens);
            $result = $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
    


    
        }
        

    }


    



