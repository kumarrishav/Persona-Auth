<?php
/**
 * Query Function, makes it easier to do PDO Queries.
 */
function query($query, $data='')
{
    global $pdo;
    
    try
    {
        $query = $pdo->prepare($query);
        
        if(!empty($data))
        {
            if( is_array($data) )
            {
                $query->execute( $data );
            }
            else
            {
                $query->execute( array($data) );
            }
        }
        else
        {
            $query->execute();
        }
        
        return $query;
    }
    catch( PDOException $error )
    {
        die('Connection failed: '.$error->getMessage());
    }
}

function redirect($url,$time=0)
{
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="'.$time.'; URL='.$url.'">';
}