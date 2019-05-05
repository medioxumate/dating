<?php
/**
 * Dating site for gay frogs
 * Created by PhpStorm.
 * @author Brian Kiehn
 * @version 2.0
 * @date 4/12/2019
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
$f3->route('GET /form', function() {
    //display a view
    $view = new Template();

    echo $view->render('views/form1.html');
});

$f3->route('GET|POST /info', function() {

    $_SESSION ['fn'] = $_POST['fn'];
    $_SESSION ['ln'] = $_POST['ln'];
    $_SESSION ['age'] = $_POST['age'];
    $_SESSION ['g'] = $_POST['g'];
    $_SESSION ['ph'] = $_POST['ph'];


    //display a view
    $view = new Template();
    echo $view->render('views/form2.html');
});

$f3->route('GET|POST /hobbies', function() {

    $_SESSION ['em'] = $_POST['em'];
    $_SESSION ['st'] = $_POST['st'];
    $_SESSION ['bio'] = $_POST['bio'];

    //display a view
    $view = new Template();
    echo $view->render('views/form3.html');
});

$f3->route('GET|POST /profile', function($f3){
    //display a view
    $view = new Template();

    $hb = $_POST['hobbies'];
    $_SESSION ['hb'] = $hb;

    echo $view->render('views/profile.html');
});

//run Fat-free
$f3->run();
