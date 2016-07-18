
<?php

/**
 * controller class
 * @author vishva ratnayake a.k.a  S.A.K.I
 */


$type_val = $_POST['fb_type'];

// remove text area value
unset($_POST['fb_type']);

$arvm = $_POST;

$arob = array(
    'fbb' => 'postFacebook',
    'tww' => 'postTwiter',
);

foreach ($arvm as $value) {
    
    //call relevent files
    require_once '../models/'.$arob[$value].'.php';
    
    // ceate object from selected media
    $arob_ob = new $arob[$value];
    $arob_ob->functionPost($type_val);
}
