<?php

class Device_session extends Model {

	// Declare properties - The id property is made automatically for every Model
	protected $sports_device;
	protected $sport_session;
	protected $session_start;
	protected $session_end;
	protected $meter_distance;
	protected $sets;
	protected $floors;


	public function __construct(){
	}

	protected static function newModel($obj){
    }

	// Getters
	public function getSports_device()
	{
		return $this->sports_device;
	}

	public function getSport_session()
	{
		return $this->sport_session;
	}

	public function getSession_start()
	{
		return $this->session_start;
	}

	public function getSession_end()
	{
		return $this->session_end;
	}

	public function getMeter_distance()
	{
		return $this->meter_distance;
	}

	public function getSets()
	{
		return $this->sets;
	}

	public function getFloors()
	{
		return $this->floors;
	}

	// Relations

	public function getSports_devices()
	{
        return $this->belongsTo('Sports_device');
    }

    public function getSport_sessions()
	{
        return $this->belongsTo('Sport_session');
    }

}

?>
