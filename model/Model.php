<?php

// This class may not be instantiated
// Extend it instead (as in 'public User extends Model') It now has full database CRUD
abstract class Model {

    // Every model has an id
    protected $id;

    // When extending this class, create protected variables in the subclass and match the property
    // names with the column names in the database (case sensitive)

    public static function saveTableRow($form){
        try {

            if (isset($form['id'])) {
                self::updateValues($form);
                App::refresh();
            } elseif (count($form) > 0) {
                $class = get_called_class();
                if ($class == "Model") throw new FrameworkException("Cannot call this method from the Model context. This must be from a child class");
                $obj = new $class();
                foreach ($form as $key => $value) {
                    if (!property_exists($obj, $key)) throw new FrameworkException("Property '" . $key . "' does not exist in '" . $class . "' class");
                    $obj->$key = $value;
                }
                if ($obj->save()) {
                    App::refresh();
                    return true;
                }
            }
            else{
                throw new FrameworkException("Parameter 'form' must be a named array");
            }
            return false;
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        } catch (Exception $e) {
            throw new FrameworkException("Unknown error");
        }
    }

    public static function updateValues($form){
        $obj = self::findById($form['id']);
        unset($form['id']);
        foreach ($form as $key => $value) {
            if (!property_exists($obj, $key)) throw new FrameworkException("Property '" . $key . "' does not exist in '" . get_called_class() . "' class");
            $obj->$key = $value;
        }
        $obj->save();
    }

    public static function findById($id)
    {
        try {
            $objs = self::findBy("id", $id);
            if (count($objs) < 1) throw new FrameworkException("There is no " . get_called_class() . " with id " . $id);
            return $objs[0];
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

    public static function findBy($field, $value)
    {
        return DB::getBy(get_called_class(), $field, $value);
    }

    public static function find() {
        try {
            $table = strtolower(get_called_class());
            $qry = "SELECT * FROM `$table`";
            $stmt = DB::prepare($qry);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());
        } catch (Exception $e) {
            echo FrameworkException::message($e->getMessage(), $e->getTrace());
            die();
        }
    }

    // Checks if object already exists and accordingly uses the update or create function

    public function save()
    {
        try {
            if ($this->id) {
                // If it has been
                return $this->update();
            } else {
                // If the object hasn't been inserted before
                return $this->create();
            }
        } catch (Exception $e) {
            echo FrameworkException::message($e->getMessage(), $e->getTrace());
            die();
        }
    }

    // Updates a record in the database

    private function update()
    {
        try {
            if (static::newModel($this)) {
                $vars = get_object_vars($this);

                $table = strtolower(get_class($this));

                $qry = "UPDATE `$table` SET ";

                foreach ($vars as $key => $value) {
                    if ($key == 'id') continue;
                    $qry .= "$key = :$key, ";
                }

                $qry = substr($qry, 0, -2);

                $qry .= " WHERE id = :id";

                $stmt = DB::prepare($qry);
                $stmt->execute($vars);
                return true;
            }
        } catch (Exception $e) {
            FrameworkException::message($e->getMessage(), $e->getTrace());
        }
        return false;
    }

    protected abstract static function newModel($obj);

    // Creates a record in the database

    private function create()
    {
        try {
            if (static::newModel($this)) {
                $vars = get_object_vars($this);

                unset($vars['id']);

                $table = strtolower(get_class($this));

                $fields = "(`" . implode("`, `", array_keys($vars)) . "`)";
                $values = "(:" . implode(", :", array_keys($vars)) . ")";

                $qry = "INSERT INTO `$table` $fields VALUES $values;";

                $stmt = DB::prepare($qry);

                $stmt->execute($vars);
                $this->id = DB::lastId();
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            FrameworkException::message($e->getMessage(), $e->getTrace());
        }
    }

    // This removes the object from the database

    public function remove()
    {
        try {
            $table = strtolower(get_called_class());
            $qry = "DELETE FROM `$table` WHERE id = :id";
            $stmt = DB::prepare($qry);
            $stmt->execute(['id' => $this->id]);
            // Set ID to null. If it is referenced from something different it returns null
            // If it is saved to the database again this ensures it calls 'create'
            $this->id = null;
        } catch (Exception $e) {
            echo FrameworkException::message($e->getMessage(), $e->getTrace());
            die();
        }
    }

    // Used to declare a one-to-many relation (include this in the Model that "has one")

    protected function belongsTo($type, $field = "")
    {
        try {
            if ($field == "") {
                $field = strtolower($type);
            }
            if (!file_exists("model/$type.php")) {
                throw new FrameworkException("Class " . $type . " does not exist. The relation is invalid");
            }
            if (!property_exists(get_called_class(), $field)) {
                throw new FrameworkException("Property " . $field . " does not exist or is private in " . get_called_class());
            }
            if (get_parent_class($type) !== "Model") {
                throw new FrameworkException("Class " . $type . " does not extend Model");
            }
            return $type::findById(get_object_vars($this)[$field]);
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

    // Used to declare a one-to-many relation (include this in the Model that "has many")

    protected function hasMany($type, $field = "")
    {
        try {
            if ($field == "") {
                $field = strtolower(get_called_class());
            }
            if (!file_exists("model/$type.php")) {
                throw new FrameworkException("Class " . $type . " does not exist. The relation is invalid");
            }
            if (get_parent_class($type) !== "Model") {
                throw new FrameworkException("Class " . $type . " does not extend Model");
            }
            return $type::findBy($field, $this->getId());
        } catch (FrameworkException $e) {
            $e->errorMessage();
            die();
        }
    }

    // Gets the current ID

    public function getId() {
        try {
            if (!isset($this->id) || $this->id === null) throw new FrameworkException(get_called_class() . " does not have an ID. Save it to the database first");
            return $this->id;
        } catch (FrameworkException $e) {
            echo $e->errorMessage();
            die();
        }
    }

}
