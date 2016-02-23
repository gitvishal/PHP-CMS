<?php
class CMSConnection
{
	private $user = "sj_innovation";
	private $pass ="sj_innovation123";
	private $dbname = "CMS";
	private $host = "localhost";
	private $stmt;
	private $dbh;
    private $error;

	public function __construct()
    {
    	$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname .';charset=utf8';
    	$options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );

        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        catch(PDOException $e){
            $this->error = $e->getMessage();
            print "error";
        }
    }

    public function verified($admin ,$password)
    {
    	$query = "SELECT * FROM user WHERE username=:name AND password=PASSWORD(:password)";
    	$this->stmt = $this->dbh->prepare($query);
    	$this->stmt->bindValue(':name', $admin, PDO::PARAM_STR);
    	$this->stmt->bindValue(':password', $password, PDO::PARAM_STR);
		$this->stmt->execute();
		return (!empty($this->stmt->fetch(PDO::FETCH_ASSOC)));
    }
}
?>