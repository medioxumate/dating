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
    return is_Numeric($age) AND 18 < $age AND  $age < 118;
}

function validPhone($phone){
    return preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $phone)||
        preg_match("/^[0-9]{3}[0-9]{3}[0-9]{4}$/", $phone);
}

function validEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function validState($state){
//Array of valid states
    $validStates = array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
        'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois',
        'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
        'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana',
        'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
        'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania',
        'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah',
        'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
        'American Samoa', 'District of Columbia', 'Guam', 'Marshall Islands', 'Northern Mariana Islands',
        'Palau', 'Puerto Rico', 'Virgin Islands');

    $valid = false;
    foreach ($validStates as $test){
        if($test == $state){
            $valid = true;
        }
    }

    return $valid;
}

function validIndoor(array $indoor){
/*  $validIndoor = array('tv','puzzles', 'movies', 'reading', 'cooking',
        'playing cards', 'board games', 'video games');

    $valid = false;
    $count = 0;
    foreach ($indoor as $in){
        if(!empty($in)){

        }
    }

    return $valid;*/
}

function validOutdoor(array $outdoor){
/*    $validOutdoor = array('swimming','hopping', 'floating', 'collecting', 'croaking');

    $valid = false;
    $count = 0;
    foreach ($validOutdoor as $door){
        foreach ()
    }
    if($count == sizeof($outdoor)){
        $valid = true;
    }

    return $valid;*/
}