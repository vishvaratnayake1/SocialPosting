<?php
require_once 'postFacebook.php';

   $loginUrl = $this->helper->getLoginUrl(base_url."home.php", $this->permissions);
            echo '<a href="' . $loginUrl . '">it seems you'
                    . ' are first time to use this app'
                    . ' click this link once  to loging to'
                    . ' facebook and accept the app </a>';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

