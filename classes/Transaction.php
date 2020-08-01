<?php

include_once (__DIR__ . "/Db.php");


class Transaction {

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

    public function makeTransfer()
    {

        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (bedrag,description) values(:bedrag, :description)");
        $username = $this->getBedrag();
        $email = $this->getDescription();
        

        if(empty($bedrag) || empty($description)) {
            throw new Exception("Alle velden moeten ingevuld worden");
            return false;

        }  else {

            $statement->bindValue(":bedrag", $bedrag);
            $statement->bindValue(":description", $description);
            $result = $statement->execute();
            return $result;

            
        


            
        }


    }

}
?>

    



