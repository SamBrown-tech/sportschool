<?php

class Device_session extends Model {

	// Declare properties - The id property is made automatically for every Model
	protected $sports_device;
	protected $sport_session;
	protected $session_start;
	protected $session_end;
	protected $meter_distance;
	protected $weight;
	protected $floors;


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

	public function getSports_device()
	{
        return $this->belongsTo('Sports_device');
    }

    public function getSport_sessions()
	{
        return $this->belongsTo('Sport_session');
    }

}

?>
