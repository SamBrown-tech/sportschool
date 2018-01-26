<?php

class Sports_device extends Model {

	// Declare properties - The id property is made automatically for every Model
	protected $name;
	protected $session_max_minutes;
	protected $calories_per_minute;
	protected $description;


	public function __construct(){
	}

	protected static function newModel($obj){
    }

	// Getters

	public function getName()
	{
		return $this->name;
	}

	public function getSession_max_minutes()
	{
		return $this->session_max_minutes;
	}

	public function getCalories_per_minute()
	{
		return $this->calories_per_minute;
	}

	public function getDescription()
	{
		return $this->description;
	}

	// Relations

    public function getDevice_sessions()
	{
        return $this->hasMany('Device_session');
    }
}
?>
