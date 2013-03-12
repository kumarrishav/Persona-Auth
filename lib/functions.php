<?php
class Database
{
    public $db,$stmt;
    
    function __construct($dsn, $username, $password, $driver_options)
    {
        try
        {
            $this->db = new PDO($dsn, $username, $password, $driver_options);
        }
        catch( PDOException $error )
        {
            die('Connection failed: '.$error->getMessage());
        }
    }
    
    function query($query, $data='')
    {
        try
        {
            $this->stmt = $this->db->prepare($query);
            
            if(!empty($data))
            {
                if( is_array($data) )
                {
                    $this->stmt->execute( $data );
                }
                else
                {
                    $this->stmt->execute( array($data) );
                }
            }
            else
            {
                $this->stmt->execute();
            }
        }
        catch( PDOException $error )
        {
            die('Connection failed: '.$error->getMessage());
        }
    }
    
    function insert_id()
    {
        return $this->db->lastInsertId();
    }
}

function redirect($url,$time=0)
{
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="'.$time.'; URL='.$url.'">';
}