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
        $input = "<input type='".$type."' id='".$type."' name='".$name."' placeholder='".$placeholder."' class='form-input'";
        switch ($type) {
            case 'email':
                $input .=  "pattern='^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$'
                            placeholder='noreply@noreply.com'
                            maxlength='50'
                            required";
                break;
            case 'password':
                $input .=  "pattern='^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{12,20}$'
                            minlength='12'
                            maxlength='20'
                            required";
                break;
            case 'text':
                $input .=  "pattern='^[A-Za-zÀ-ÿ ]+$'
                            maxlength='20'
                            required";
                break;
        }
        $input .= "/>";
        $this->input[] = $input;
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