<?php

class User 
{
    /*
    * @var int
    */
    private $id;

    /*
    * @var string
    */
    private $firstname;

    /*
    * @var string
    */
    private $lastname;

    /*
    * @var string
    */
    private $email;

    /*
    * @var string
    */
    private $password;

    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }


    public function hydrate(array $datas) {
        foreach ($datas as $key => $value)
        {
          $method = 'set'.ucfirst($key);
              
          if (method_exists($this, $method)) {
            $this->$method($value);
          }
        }
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
}