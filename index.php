<?php
/**
 * Dating site for gay frogs
 * Created by PhpStorm.
 * @author Brian Kiehn
 * @version 3.0
 * @date 5/5/2019
 *
 */

//Session
session_start();

//turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require autoload file
require_once('vendor/autoload.php');

//create an instance of the Base class/ fat free object
//instantiate fat free
$f3 = Base::instance();

//turn on fatfree error reporting
//debugging in fat free is difficult
$f3->set('DEBUG', 3);


//Define a default root
$f3->route('GET /', function(){
    //display a view
    $view = new Template();
    echo $view->render('views/home.html');
});

//Form routes
$f3->route('GET|POST /form', function($f3) {
    //display a view
    $template = new Template();

    //check if $POST even exists, then validate
    if (isset($_POST['fn'])&&isset($_POST['ln'])&&isset($_POST['age'])
        &&isset($_POST['g'])&&isset($_POST['ph'])) {
        //check valid strings and numbers
        if (validString($_POST['fn'])&&validString($_POST['ln'])&&is_Numeric($_POST['age'])
            &&is_numeric($_POST['ph'])) {

            $_SESSION ['fn'] = $_POST['fn'];
            $_SESSION ['ln'] = $_POST['ln'];
            $_SESSION ['age'] = $_POST['age'];
            $_SESSION ['g'] = $_POST['g'];
            $_SESSION ['ph'] = $_POST['ph'];

            $f3->reroute('/info');
        }
        else
        {
            //instantiate an error array with message
            if(!validString($_POST['fn'])||validString($_POST['ln'])){
                $f3->set("error: not a valid name.");
            }
            if((!is_Numeric($_POST['age']))){
                $f3->set("error: not a valid age.");
            }
            if(!is_numeric($_POST['ph'])){
                $f3->set("error: not a valid phone number.");
            }
        }
    }
    echo $template->render('views/form1.html');
});

$f3->route('GET|POST /info', function($f3) {
    $template = new Template();
    //check if $POST even exists, then validate
    if (isset($_POST['em'])&&isset($_POST['st'])&&isset($_POST['bio'])) {
        //check valid strings and numbers
        if (filter_var($_POST['em'], FILTER_VALIDATE_EMAIL)&&
            validString($_POST['st'])) {

            $_SESSION ['em'] = $_POST['em'];
            $_SESSION ['st'] = $_POST['st'];
            $_SESSION ['bio'] = $_POST['bio'];

            $f3->reroute('/hobbies');
        }
        else
        {
            //instantiate an error array with message
            if(!(filter_var($_POST['em'], FILTER_VALIDATE_EMAIL))){
                $f3->set("error: not a valid email.");
            }
            if(!validString($_POST['st'])){
                $f3->set("error: not a valid state.");
            }
        }
    }
    echo $template->render('views/form2.html');
});

$f3->route('GET|POST /hobbies', function() {

    //display a view
    $view = new Template();
    echo $view->render('views/form3.html');
});

$f3->route('GET|POST /profile', function(){
    //display a view
    $view = new Template();
/*
    $_SESSION ['hb'] = $_POST['hobbies'];
    foreach($_SESSION['hb'] as $value){
        echo $value.',';
    };
*/
    echo $view->render('views/profile.html');
});

//run Fat-free
$f3->run();