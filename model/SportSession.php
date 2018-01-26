<?php

class Sport_session extends Model {

	// Declare properties - The id property is made automatically for every Model
	protected $session_start;
	protected $session_end;
	protected $user;
	protected $location;

	public function __construct(){
	}

	protected static function newModel($obj){
    }

	// Getters

	public function getSession_start()
	{
		return $this->session_start;
	}

	public function getSession_end()
	{
		return $this->session_end;
	}

	// Relations

	public function getUser()
	{
        return $this->belongsTo('User');
    }

    public function getLocation()
	{
        return $this->belongsTo('Location');
    }

}

?>
