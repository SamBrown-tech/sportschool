<?php

/**
 * Created by PhpStorm.
 * User: santino
 * Date: 19-4-17
 * Time: 14:14
 */
class Form
{
    private $fields = [];
    private $action;
    private $method;
    private $hasSubmit = false;
    private $includeSubmit;

    public function __construct($action = null, $method = "POST", $includeSubmit = true)
    {
        $this->includeSubmit = $includeSubmit;
        $this->action = $action;
        $this->method = $method;
    }

    public function addField($field){
        try {
            if (get_class($field) != "FormField") {
                throw new FrameworkException("Argument must be of type FormField");
            }
            array_push($this->fields, $field);
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

    public function getHTML(){
        $html = "<form method='$this->method'";
        if($this->action) $html .= " action='$this->action'";
        $html .= ">";

        foreach ($this->fields as $field){
            $html .= $field->getHTML();
            if (strtolower($field->getType()) == "submit") {
                $this->hasSubmit = true;
            }
        }

        if ($this->includeSubmit && !$this->hasSubmit) {
            $html .= "<input type='submit' value='save'>";
        }

        $html .= "</form>";
        return $html;
    }
}
