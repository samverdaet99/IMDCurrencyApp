<?php

include_once (__DIR__ . "/Db.php");


class Transaction{

    private $id;
    private $bedrag;
    private $description;


    

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

          //else if ($username['tokens'] < 0){
            //throw new Exception("Je hebt niet voldoende tokens");
            //return false;
        //} else {
           // $result = $statement->execute();
            //return $result;

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




    public function makeTransfer(){
        $conn = Db::getConnection();
        $statement = $conn->prepare("insert into transfers (id,bedrag,description) values(:id, :bedrag, :description)");
        $id = $this->getId();
        $bedrag = $this->getBedrag();
        $description = $this->getDescription();


        if(empty($bedrag) || empty($description) ){
            throw new Exception("Alle velden moeten ingevuld worden");
        }
            else {
            $statement->bindValue(":id", $id);
            $statement->bindValue(":bedrag", $bedrag);
            $statement->bindValue(":description", $description);
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