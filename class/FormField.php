<?php

/**
 * Created by PhpStorm.
 * User: santino
 * Date: 19-4-17
 * Time: 14:17
 */
class FormField
{
    private $type;
    private $name;
    private $placeholder;
    private $value;
    private $required;
    private $attributes = [];

    public function __construct($name, $type = "text", $placeholder = "", $value = "")
    {
        $this->name = $name;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    public function name($name)
    {
        $this->name = $name;
        return $this;
    }


    public function type($type)
    {
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function placeholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }


    public function value($value)
    {
        $this->value = $value;
        return $this;
    }

    public function required()
    {
        $this->required = true;
        return $this;
    }

    public function addAttribute($attr)
    {
        array_push($this->attributes, $attr);
        return $this;
    }

    public function getHTML(){
        if($this->type == "checkbox"){
            $html = $this->placeholder . "<";
        }
        else {
            $html = "<";
        }
        switch ($this->type){
            case "select":
            case "textarea":
                $html .= $this->type . " ";
                break;
            default:
                $html .= "input type='$this->type' ";
                break;
        }

        $html .= "name='$this->name' ";
        $html .= "placeholder='$this->placeholder' ";


        if($this->required) $html .= "required ";
        switch ($this->type){
            case "textarea":
                $html .= "></" . $this->type;   
                break;
            case "select":
                $html .= ">";
                foreach ($this->value as $key => $val) {
                    $html .= "<option value='$key'>$val</option>";
                }
                $html .= "</$this->type";
                break;
            default:
                if ($this->value) $html .= "value='$this->value' ";
                break;
        }

        foreach ($this->attributes as $attr) {
            $html .= $attr . " ";
        }

        $html .= ">";
        if($this->type != "hidden") $html .= "<br>";
        return $html;
    }
}
