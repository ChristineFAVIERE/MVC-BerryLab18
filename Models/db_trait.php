<?php
$user = 'root';
$password = '';
trait PDO{
    public function connexionBdd($hote,$user,$password,$sdb)
{
    $dsn ='mysql:dbname='.'$db'.'host='.$hote;
    $dbh = new PDO($dsn,$user,$password);
    return $dbh;
}
    
}
