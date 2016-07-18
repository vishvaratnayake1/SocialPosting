<?php

require_once("/twitteroauth-master/autoload.php");
use Abraham\TwitterOAuth\TwitterOAuth;
require_once './config.php';
/**
 * twitter login , poting functions are here
 *
 * @author S.A.K.I
 */
class PostTwiter  {   
    public function __construct() {
        
    }
    
    public function functionPost($msg) {
        
        // define twitter object
        $tw = new TwitterOAuth(consumer_key,
                consumer_secret,
                access_token,
                access_token_secret);
        $content = $tw->get("account/verify_credentials");
        
        // check length
        if(strlen($msg) > 140) {
                $status = substr($msg, 0, 140);
        }
        
        //post
        $tw->post('statuses/update', array(
                'status' => $msg
        ));
        
        
        echo "successfully posted to twitter";
         
    }


}
