<?php
/**
 * Created by PhpStorm.
 * @author Brian Kiehn
 * @version 2.0
 * @date 5/8/2019
 *
 */


//functions
/*
 * @param $String
 */
function validName($String){
    return ctype_alpha($String) AND ($String !="");
}

function validAge($age){
    if(is_Numeric($age) AND 18 > $age AND  $age < 118) {
        return true;
    };
}

function validPhone($phone){
    return preg_match("/^[0-9][3}-[0-9]{4}-[0-9]{4}$/", $phone)||
        preg_match("/^[0-9][3}[0-9]{4}[0-9]{4}$/", $phone);
}

function validEmail($email){
    return filter_var($_POST['em'], FILTER_VALIDATE_EMAIL);
}

function validState($state){

}

function validOutdoor(){

}

function validIndoor(){

}