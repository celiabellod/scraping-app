<?php
namespace App\Entity;

use App\Model\Model;

class Extraction extends Model
{

    /**
     * @var int
     */
    protected $id;

    /**
    * @var String
    */
    protected $url;

    /**
    * @var String
    */
    protected $name;

    /**
    * @var String
    */
    protected $type;

    /**
    * @var String
    */
    protected $periodicity;

    /**
    * @var String
    */
    protected $category;

    /**
    * @var String
    */
    protected $primaryContainer;

    /**
    * @var String
    */
    protected $secondaryContainer;

    /**
     * @var Array
     */
    protected $datas;

     /**
     * @var User
     */
    protected $user;


    public function __construct()
    {
        $this->table = 'extraction';
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
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set /*
     *
     * @param  string  $url  /*
     *
     * @return  self
     */ 
    public function setUrl(string $url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set /*
     *
     * @param  string  $name  /*
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getPeriodicity()
    {
        return $this->periodicity;
    }

    /**
     * Set /*
     *
     * @param  string  $periodicity  /*
     *
     * @return  self
     */ 
    public function setPeriodicity(string $periodicity)
    {
        $this->periodicity = $periodicity;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set /*
     *
     * @param  string  $category  /*
     *
     * @return  self
     */ 
    public function setCategory(string $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getPrimaryContainer()
    {
        return $this->primaryContainer;
    }

    /**
     * Set /*
     *
     * @param  string  $primaryContainer  /*
     *
     * @return  self
     */ 
    public function setPrimaryContainer(string $primaryContainer)
    {
        $this->primaryContainer = $primaryContainer;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getSecondaryContainer()
    {
        return $this->secondaryContainer;
    }

    /**
     * Set /*
     *
     * @param  string  $secondaryContainer  /*
     *
     * @return  self
     */ 
    public function setSecondaryContainer(string $secondaryContainer)
    {
        $this->secondaryContainer = $secondaryContainer;

        return $this;
    }

    /**
     * Get /*
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set /*
     *
     * @param  string  $type  /*
     *
     * @return  self
     */ 
    public function setType(string $type)
    {
        $this->type = $type;

        return $this;
    }


    /**
     * Get the value of datas
     *
     * @return  Array
     */ 
    public function getDatas()
    {
        return $this->datas;
    }

    /**
     * Set the value of datas
     *
     * @param  Array  $datas
     *
     * @return  self
     */ 
    public function setDatas()
    {
        $datasManager = new Datas();
        $datas = $datasManager->findBy(['extraction_id' => $this->getId()]);
        foreach($datas as $data){
            $this->datas[] =  $datasManager->hydrate($data);
        }
        $this->datas = $datas;

        return $this;
    }

    /**
     * Get the value of user
     *
     * @return  User
     */ 
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set the value of user
     *
     * @param Int $user_id
     *
     * @return self
     */ 
    public function setUser($user_id)
    {
        $userManager = new User();
        $user = $userManager->find($user_id);
        $user = $userManager->hydrate($user);
        $this->user = $user;

        return $this;
    }
}