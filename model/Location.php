<?php

class Location extends Model {

	// Declare properties - The id property is made automatically for every Model
	protected $name;
	protected $street;
	protected $postal_code;
	protected $house_number;

	public function __construct(){
	}

	// Asks for all properties that are NN in the database and registers a new location

	public static function register($name, $street, $postal_code, $house_number)
	{
		$location = new Location();
		$location->name = $name;
		$location->street = $street;
		$location->postal_code = $postal_code;
		$location->house_number = $house_number;

        if ($location->save()) {
            return $location;
        } else {
            return false;
        }
    }

	// Generates a form to add a new location

    public static function addLocationForm(){
    	$form = new Form();

    	$form->addField((new FormField("name"))->type("text")->placeholder("Naam"));
    	$form->addField((new FormField("description"))->type("text")->placeholder("Beschrijving"));
		$form->addField((new FormField("postal_code"))->type("text")->placeholder("Postcode"));
		$form->addField((new FormField("house_number"))->type("number")->placeholder("Huisnummer"));

    	return $form;
    }

	protected static function newModel($obj)
	{
		return true;
    }

	// Getters

    public function getName(){
    	return $this->name;
    }

	// Relations

	public function getSportSessions()
	{
        return $this->hasMany('SportSession');
    }
}

?>
