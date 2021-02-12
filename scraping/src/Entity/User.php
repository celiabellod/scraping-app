<?php
namespace App\src\Entity;

use App\src\Model\Model;

class User extends Model
{
    /*
    * @var int
    */
    protected $id;

    /*
    * @var string
    */
    protected $uuid;

    /*
    * @var string
    */
    protected $firstname;

    /*
    * @var string
    */
    protected $lastname;

    /*
    * @var string
    */
    protected $email;

    /*
    * @var string
    */
    protected $password;

    /*
    * @var bool
    */
    protected $emailVerif = 0;
  
    public function __construct()
    {
        $this->createTable();
        $this->table = 'user';
    }

    /**
     * Get /*
     *
     * @return  int
     */ 
    public function getId()
    {
        return $this->id;
    }

        /**
     * Set /*
     *
     * @param  int  $id  /*
     *
     * @return  self
     */ 
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set /*
     *
     * @param  string  $firstname  /*
     *
     * @return  self
     */ 
    public function setFirstname(string $firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set /*
     *
     * @param  string  $lastname  /*
     *
     * @return  self
     */ 
    public function setLastname(string $lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set /*
     *
     * @param  string  $email  /*
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set /*
     *
     * @param  string  $password  /*
     *
     * @return  self
     */ 
    public function setPassword(string $password)
    {
        $this->password = $password;

        return $this;
    }


    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set /*
     *
     * @param  string  $uuid  /*
     *
     * @return  self
     */ 
    public function setUuid(string $uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }


    /**
     * Get /*
     *
     * @return  bool
     */ 
    public function getEmailVerif()
    {
        return $this->emailVerif;
    }

    /**
     * Set /*
     *
     * @param  bool $emailVerif  /*
     *
     * @return  self
     */ 
    public function setEmailVerif(Bool $emailVerif)
    {
        $this->emailVerif = $emailVerif;

        return $this;
    }
}