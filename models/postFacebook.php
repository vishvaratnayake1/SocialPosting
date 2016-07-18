<?php
session_start();
//require_once __DIR__ . '/src/Facebook/autoload.php';
require_once '../config/config.php';
require_once '../src/Facebook/autoload.php';


/**
 * facebook login , poting functions are here
 *
 * @author S.A.K.I
 */
class PostFacebook {
    private $facebook = null;
    private $helper = null;
    private $accessToken = null;
    private $user_message = null;
    private $permissions = ['publish_actions'];

    /**
     * initialise facebook object using credentials
     * @param  null
     */
    public function __construct() {

        
        $this->facebook = new Facebook\Facebook([
            'app_id' => fb_app_id,
            'app_secret' => fb_app_secret,
            'default_graph_version' => fb_default_graph_version,
        ]);
      
        
        $this->helper = $this->facebook->getRedirectLoginHelper();
       
    }
    
    /**
     * relevent post is received 
     * @param type $msg 
     */
     public function functionPost($msg) {
        $this->user_message = $msg;
        $this->initialize();
    }

    /**
     * get acces token and set to session variable
     */
    private function initialize() {
        try {
            
          
            $_SESSION['facebook_access_token']= access_tokan;
            if (isset($_SESSION['facebook_access_token'])) {
                $this->accessToken = $_SESSION['facebook_access_token'];
                echo '1';
            } else {               
                $this->accessToken = $this->helper->getAccessToken();
                echo $this->accessToken;
            }
        } catch (Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }
        
        /**
         * access token management
         */
        if (isset($this->accessToken)) {
            if (isset($_SESSION['facebook_access_token'])) {
                $this
                ->facebook
                ->setDefaultAccessToken($_SESSION['facebook_access_token']);
            } else {
                // getting short-lived access token
                $_SESSION['facebook_access_token']= (string) $this->accessToken;
                // OAuth 2.0 client handler
                $oAuth2Client = $this->facebook->getOAuth2Client();
                
                // Exchanges a short-lived access token for a long-lived one
                $longLivedAccessToken = $oAuth2Client
                ->getLongLivedAccessToken($_SESSION['facebook_access_token']);
                $_SESSION['facebook_access_token'] = (string) $longLivedAccessToken;
                
                // setting default access token to be used in script
                $this
                ->facebook
                ->setDefaultAccessToken($_SESSION['facebook_access_token']);
            }
            // redirect the user back to the same page if it has "code" GET variable
            if (isset($_GET['code'])) {                
                header('Location: ./');
            }
            
            //post is done
           $post = $this->facebook->post('/me/feed', array('message'
           => $this->user_message));
            
            echo "successfully posted to facebook";
            
        } else {
            // if user dosnt loged in and dosent accept the application
            $loginUrl = $this->helper->getLoginUrl(base_url."home.php", $this->permissions);
            echo '<a href="' . $loginUrl . '">it seems you'
                    . ' are first time to use this app'
                    . ' click this link once  to loging to'
                    . ' facebook and accept the app </a>';
        }
    }

   

}
