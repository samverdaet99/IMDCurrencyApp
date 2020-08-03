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
        //if ($bedrag < 1 )
          //{
            //throw new Exception ("Het bedrag moet minstens 1 zijn");
          //}

          //else if ($username['tokens'] < 0){
            //throw new Exception("Je hebt niet voldoende tokens");
            //return false;
        //} else {
           // $result = $statement->execute();
            //return $result;


        //$this->bedrag = $bedrag;

        //return $this;
        //}

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


   


    //-----------Functions 




    public function saveTransfers(){

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (bedrag,description)values (:bedrag, :description) ");
        
        $bedrag = $this->getBedrag();
        $description = $this->getDescription();

    //if(empty($bedrag) || empty($description)) {
       //throw new Exception("Alle velden moeten ingevuld worden");
            //return false;
        //}            
         // else {

    $statement->bindValue(":bedrag", $bedrag);
    $statement->bindValue(":description", $description);
        

        $result = $statement->execute();
        return $result;

            
        //}
    }


    public static function getAll($bedrag){
        $conn = Db::getConnection();
        $statement = $conn->prepare('select $ from transfers where bedrag = :bedrag');
        $statement->bindValue(':bedrag', $bedrag);

        $result = $statement-execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);


    }

    // tokens 


    public function checkTokens($tokens)
    {
    $conn = Db::getConnection();
    $statement = $conn->prepare("select * from users where tokens = :tokens");
    $tokens = $tokens;
    $statement->bindValue(':tokens', $tokens);
    $result = $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;

        


}



        






    }




        

    


    



