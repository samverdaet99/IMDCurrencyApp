<?php

include_once (__DIR__ . "/Db.php");



class Overzicht{

    private $id;
    private $user_ontvanger;
    private $user_verzender;
    private $transfer_id;

    




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



    //------------functions------------
}