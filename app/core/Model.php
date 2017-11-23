<?php

class Model{
	protected $_connection;
    protected $_className = null;
    protected $_whereClause;
    protected $_orderBy;
    protected $_PKName = 'id';// default name for the primary key
	
	//TODO: add JOIN clauses
	
	public function __construct(PDO $connection = null)
    {
		//database parameters
		$server = 'localhost';
		$DBName = 'test';
		$user = 'root';
		$pass = '';
		
        $this->_connection = $connection;
        if ($this->_connection === null) {
            $this->_connection = new PDO("mysql:host=$server;dbname=$DBName", $user, $pass);
            $this->_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
		$this->_className = get_class($this);
    }

	protected function getProps(){
		//extract the deriving class name
		$exclusions = get_class_vars(__CLASS__);//properties from the Model base class to exclude from SQL
		
        //extract the deriving class properties
        $classProps = [];
		$array = get_object_vars($this);
		foreach ($array as $key => $value) {
			if(!array_key_exists($key, $exclusions))
				$classProps[] = $key;
		}
		return $classProps;
	}
	
	protected function toArray($properties){
        $data = [];
        foreach($properties as $prop)
            $data[$prop] = $this->$prop;
		return $data;
    }

    public function find($ID)
    {
		$selectOne 	= "SELECT * FROM $this->_className WHERE $this->_PKName = :$this->_PKName";

        $stmt = $this->_connection->prepare($selectOne);
        $stmt->execute(array($this->_PKName=>$ID));

        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
		$value = $stmt->fetch();
		//TODO: should this cause an exception when no record is found?
        return $value;
    }

    // SELECT * FROM Client WHERE firstName = 'Jon' AND lastName = 'Doe'
    public function where($field, $op, $value){
        //TODO : only if this is a string-type value
        $value = $this->_connection->quote($value);
        if($this->_whereClause == '')
            $this->_whereClause .= "WHERE $field $op $value";
        else
            $this->_whereClause .= " AND $field $op $value";
        return $this;
    }

    public function whereFields($fields){
        $value = $this->_connection->quote($value);
        foreach($fields as $field){
            if($this->_whereClause == '')
                $this->_whereClause .= "WHERE $field[0] $field[1] $field[2]";
            else
                $this->_whereClause .= " AND $field[0] $field[1] $field[2]";
        }
        return $this;
    }

    // SELECT * FROM Client ... ORDERBY firstName ASC, lastName ASC
    public function orderBy($field, $order = 'ASC'){
        if($this->_orderBy == '')
            $this->_orderBy .= "ORDERBY $field $order";
        else
            $this->_orderBy .= ", $field $order";
        return $this;
    }

	//run select statements
    public function get(){
		$select	= "SELECT * FROM $this->_className $this->_whereClause $this->_orderBy";

        $stmt = $this->_connection->prepare($select);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->_className);
        $returnVal = [];
        while($rec = $stmt->fetch()){
            $returnVal[] = $rec;
        }
        return $returnVal;
    }

    public function insert(){
		$properties = $this->getProps();
		$num = count($properties);
		$insert = '';
		if ($num  > 0){
			$insert 	= 'INSERT INTO ' . $this->_className . '(' . implode(',', $properties) . ') VALUES (:'. implode(',:', $properties) . ')';
		}
        $stmt = $this->_connection->prepare($insert);
        $stmt->execute($this->toArray($properties));
        return $this->_connection->lastInsertId();
	}

	public function update(){
		$properties = $this->getProps();
		$num = count($properties);
		$update = '';
		if ($num  > 0){
			//update
			$setClause = [];
			foreach($properties as $item){
                if($item != "id"){
                    $setClause[] = sprintf('%s = :%s', $item, $item);
                }
            }
			$setClause = implode(', ', $setClause);
			$update = 'UPDATE ' . $this->_className . ' SET ' . $setClause . " WHERE $this->_PKName = :$this->_PKName";
		}

		$properties[]=$this->_PKName;
        $stmt = $this->_connection->prepare($update);
        $stmt->execute($this->toArray($properties));
	}

	public function delete(){
		$delete = "DELETE FROM $this->_className WHERE $this->_PKName = :$this->_PKName";
        $stmt = $this->_connection->prepare($delete);
        $stmt->execute(array($this->_PKName=>$this->{$this->_PKName}));
    }
}
?>