<?php
/**
 * Simple implementation of Mozilla Persona
 * Original Code written by Guillaume. Big thanks and props to him.
 * 
 * @link http://www.mozilla.org/en-US/persona/
 * @link http://tools.atto.be/browserid/ (Original Code)
 * @link https://github.com/Blaxus/Persona-Auth
 * 
 * @author Guillaume <guillaume@atto.be>
 * @author David <admin@daviddhont.com>
 */
class Persona
{
    /**
     * Internal Data for use within the class.
     */
    private $audience;
    private $assertion;
    private $email;
    private $validity;
    private $issuer;
    
    /**
     * Post Request
     * 
     * @param string $url The url to post to.
     * @param string $data The data to be sent.
     * 
     * @return mixed returned contents.
     */
    private function post_request($url, $data)
    {
        $params = array('http' => array('method' => 'POST', 'content' => $data));
        $ctx = stream_context_create($params);
        $fp = fopen($url, 'rb', false, $ctx);
        
        if($fp)
        {
            return stream_get_contents($fp);
        }
        else
        {
            return FALSE;
        }
    }
    
    
    /**
     * Constructor
     * 
     * @param string $audience The audience to be used.
     * @param string $assertion The assertion to be used.
     */
    public function __construct($audience, $assertion)
    {
        $this->audience = $audience;
        $this->assertion = $assertion;
    }
    
    /**
     * Verify Assertion
     * 
     * Send the assertion to the persona server (this must be over HTTPS)
     * The response is read to determine is the assertion is authentic.
     * 
     * @return bool Returns true upon success.
     */
    public function verify_assertion()
    {
        $parameters = http_build_query(array('assertion' => $this->assertion, 'audience' => $this->audience));
        $result = json_decode($this->post_request('https://login.persona.org/verify', $parameters), TRUE, 2);
        
        if(isset($result['status']) && $result['status'] == 'okay')
        {
            $this->email = $result['email'];
            $this->validity = $result['valid-until'];
            $this->issuer = $result['issuer'];
            return true;
        }
        else
        {
            return false;
        }
    }
    
    /**
     * All functions below are Getters!
     */
    public function get_email()
    {
        return $this->email;
    }
    
    public function get_validity()
    {
        return $this->validity;
    }
    
    public function get_issuer()
    {
        return $this->issuer;
    }
}