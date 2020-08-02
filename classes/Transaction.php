<?php

include_once (__DIR__ . "/Db.php");


class Transfers {

    private $bedrag;
    private $description;
    private $tokens;



	
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
     * Get the value of bedrag
     */ 
    public function getTokens()
    {
        return $this->tokens;
    }

    /**
     * Set the value of bedrag
     *
     * @return  self
     */ 
    public function setTokens($tokens)
    {
        $this->tokens = $tokens;

        return $this;
    }


   





    //-----------Functions 

    public function makeTransfer($bedrag=0,$description=0)
    {

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (bedrag,description) values(:bedrag, :description)");
        $bedrag = $this->getBedrag();
        $description = $this->getDescription();
        $transfers = $statement->fetch(PDO::FETCH_ASSOC);
        

        if(empty($bedrag) || empty($description)) {
            throw new Exception("Alle velden moeten ingevuld worden");
            return false;

        }  else if (empty($bedrag) > ($tokens)) {
                throw new Exception("Je hebt niet voldoende tokens");
                return false;
    
            } 
            
            else {

            $statement->bindValue(":bedrag", $bedrag);
            $statement->bindValue(":description", $description);
            $result = $statement->execute();
            return $result;

            
        


            
        }


    }


    public function checkTokens($tokens)
    {
        $conn = Db::getConnection();
        $balance = $conn->prepare("SELECT * FROM users WHERE (tokens = :tokens)" );

        if ($balance < 0){
            throw new Exception("Je hebt niet voldoende tokens");
            return false;
        }
            else {
            $result = $statement->execute();
            return $result;

            
        


            
        }

        
    }




        

    }


    



