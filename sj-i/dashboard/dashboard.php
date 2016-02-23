<?php
class Database{
    private $host      = DB_HOST;
    private $user      = DB_USER;
    private $pass      = DB_PASS;
    private $dbname    = DB_NAME;
    private $stmt;
    private $dbh;
    private $error;
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){
    	$this->stmt = $this->dbh->prepare($query);
    }
    public function bind($param, $value, $type = null)
    {
    	if (is_null($type)) {
        	switch (true) {
            	case is_int($value):
                	$type = PDO::PARAM_INT;
                	break;
            	case is_bool($value):
                	$type = PDO::PARAM_BOOL;
                	break;
            	case is_null($value):
                	$type = PDO::PARAM_NULL;
                	break;
            	default:
                	$type = PDO::PARAM_STR;
        		}
    	}
    $this->stmt->bindValue($param, $value, $type);
	}

	public function execute(){
    	return $this->stmt->execute();
    }

    public function resultset(){
    	$this->execute();
    	return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function single(){
    	$this->execute();
    	return $this->stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function rowCount(){
    	return $this->stmt->rowCount();
	}

	public function lastInsertId(){
    	return $this->dbh->lastInsertId();
	}

	public function beginTransaction(){
    	return $this->dbh->beginTransaction();
	}

	public function endTransaction(){
    	return $this->dbh->commit();
	}

	public function cancelTransaction(){
    	return $this->dbh->rollBack();
	}

	public function debugDumpParams(){
    	return $this->stmt->debugDumpParams();
	}

}


/*


CREATE TABLE mytable (
    ID int(11) NOT NULL AUTO_INCREMENT,
    FName varchar(50) NOT NULL,
    LName varchar(50) NOT NULL,
    Age int(11) NOT NULL,
    Gender enum('male','female') NOT NULL,
    PRIMARY KEY (ID)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;


//Insert a new record

$database = new Database();

$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');

$database->bind(':fname', 'John');
$database->bind(':lname', 'Smith');
$database->bind(':age', '24');
$database->bind(':gender', 'male');

$database->execute();

echo $database->lastInsertId();

Insert multiple records using a Transaction

$database->beginTransaction();

$database->query('INSERT INTO mytable (FName, LName, Age, Gender) VALUES (:fname, :lname, :age, :gender)');

$database->bind(':fname', 'Jenny');
$database->bind(':lname', 'Smith');
$database->bind(':age', '23');
$database->bind(':gender', 'female');

$database->execute();

$database->bind(':fname', 'Jilly');
$database->bind(':lname', 'Smith');
$database->bind(':age', '25');
$database->bind(':gender', 'female');

$database->execute();

echo $database->lastInsertId();

$database->endTransaction();

Select a single row

$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE FName = :fname');
$database->bind(':fname', 'Jenny');
$row = $database->single();
echo "<pre>";
print_r($row);
echo "</pre>";

Select multiple rows

$database->query('SELECT FName, LName, Age, Gender FROM mytable WHERE LName = :lname');	
$database->bind(':lname', 'Smith');
$rows = $database->resultset();
echo "<pre>";
print_r($rows);
echo "</pre>";
echo $database->rowCount();

*/
 ?>