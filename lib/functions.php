<?php
/**
 * @author Aaron D. Campbell
 * @link http://bluedogwebservices.com/replace-every-other-occurrence-with-str_replace/
 * 
 * Replaces every other occurrence of search in haystack with replace
 * 
 * @param $needle mixed
 * @param $replace mixed
 * @param $haystack mixed
 * @param $count int[optional]
 * @param $replace_first bool[optional] - Default true
 * @return mixed
 */
function str_replace_every_other($needle, $replace, $haystack, &$count=null, $replace_first=true)
{
    $count = 0;
    $offset = strpos($haystack, $needle);
    
    if (!$replace_first)
    {
        $offset += strlen($needle);
        $offset = strpos($haystack, $needle, $offset);
    }
    
    while($offset !== false)
    {
        $haystack = substr_replace($haystack, $replace, $offset, strlen($needle));
        $count++;
        $offset += strlen($replace);
        $offset = strpos($haystack, $needle, $offset);
        
        if($offset !== false)
        {
            $offset += strlen($needle);
            $offset = strpos($haystack, $needle, $offset);
        }
    }
    
    return $haystack;
}

function bindParams( $input, $data )
{
    $output = $input;
    
    if(!empty($data))
    {
        if(is_array($data))
        {
            foreach($data as $key => $value)
            {
                $value = (!empty($value)) ? $value : 0;
                
                if(is_numeric($key))
                {
                    $key = ':'.($key+1);
                    $output = str_replace_every_other('?', "'".mysql_real_escape_string($value)."'", $output);
                }
                else
                {
                    $key = ':'.$key;
                    $output = str_replace($key, "'".mysql_real_escape_string($value)."'", $output);
                }
            }
        }
        else
        {
            $output = str_replace('?', "'".mysql_real_escape_string($data)."'", $output);
        }
    }
    
    return $output;
}

function redirect($url,$time=0)
{
    echo '<META HTTP-EQUIV="REFRESH" CONTENT="'.$time.'; URL='.$url.'">';
}