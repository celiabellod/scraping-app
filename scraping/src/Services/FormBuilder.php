<?php
namespace App\src\Services;

class FormBuilder 
{
    /**
     * @var String
     */
    private $title;

    /**
     * @var Array
     */
    private $info = [
        'name' => '',
        'link' => ''
    ];

    /**
     * @var Array
     */
    private $input = [];
   

    public function add($type, $name, $placeholder) 
    {
        $this->input[] = [
            'type' => $type,
            'name' => $name,
            'placeholder' => $placeholder
        ];
    }

    /**
     * Get the value of title
     *
     * @return  String
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @param  String  $title
     *
     * @return  self
     */ 
    public function setTitle(String $title)
    {
        $this->title = $title;

        return $this;
    }


    /**
     * Get the value of info
     *
     * @return  ArrayCreate my acco
     */ 
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * Set the value of info
     *
     * @param  Array  $info
     *
     * @return  self
     */ 
    public function setInfo(Array $info)
    {
        $this->info = $info;

        return $this;
    }

    /**
     * Get the value of input
     *
     * @return  Array
     */ 
    public function getInput()
    {
        return $this->input;
    }

 
}