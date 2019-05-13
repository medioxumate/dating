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
require('model/validation-functions.php');

//create an instance of the Base class/ fat free object
//instantiate fat free
$f3 = Base::instance();

//turn on fatfree error reporting
//debugging in fat free is difficult
$f3->set('DEBUG', 3);

//Interests arrays
$f3->set('in', array('tv', 'puzzles', 'movies', 'reading', 'cooking',
    'playing cards', 'board games', 'video games'));
$f3->set('out', array('swimming', 'hopping', 'singing', 'floating',
    'collecting', 'croaking'));

//State array
$f3->set('states', array('Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado',
    'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois',
    'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland',
    'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana',
    'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York',
    'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania',
    'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah',
    'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming',
    'American Samoa', 'District of Columbia', 'Guam', 'Marshall Islands', 'Northern Mariana Islands',
    'Palau', 'Puerto Rico', 'Virgin Islands'));

//sticky
$f3->set('fn', ' ');
$f3->set('ln', ' ');
$f3->set('age', ' ');
$f3->set('ph', ' ');
$f3->set('em', ' ');

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
        &&isset($_POST['ph'])) {

        //check valid strings and numbers
        if (validAge($_POST['age']) && validName($_POST['fn'])
            && validName($_POST['ln'])&& validPhone($_POST['ph'])) {

            $_SESSION ['fn'] = $_POST['fn'];
            $_SESSION ['ln'] = $_POST['ln'];
            $_SESSION ['age'] = $_POST['age'];
            $_SESSION ['ph'] = $_POST['ph'];
            if(isset($_POST['g'])){
                $_SESSION ['g'] = $_POST['g'];
            }

            $f3->reroute('/info');
        }
        else
        {
            //instantiate an error array with message
            if(!validName($_POST['fn'])){
                $f3->set("errors['fn']", "error: not a valid name.");
            }
            if(!validName($_POST['ln'])){
                $f3->set("errors['ln']", "error: not a valid name.");
            }
            if(!validAge($_POST['age'])){
                $f3->set("errors['age']", "error: not a valid age.");
            }
            if(!validPhone($_POST['ph'])){
                $f3->set("errors['ph']", "error: not a valid phone number.");
            }
            $f3->set('fn', $_POST['fn']);
            $f3->set('ln', $_POST['ln']);
            $f3->set('age', $_POST['age']);
            $f3->set('ph', $_POST['ph']);
        }
    }
    echo $template->render('views/form1.html');
});

$f3->route('GET|POST /info', function($f3) {
    $template = new Template();

    //check if $POST even exists, then validate
    if (isset($_POST['em'])&&isset($_POST['st'])) {
        //check valid strings and numbers
        if (validEmail($_POST['em']) && validState($_POST['st'])) {

            $_SESSION ['em'] = $_POST['em'];
            $_SESSION ['st'] = $_POST['st'];
            if(isset($_POST['bio'])){
                $_SESSION ['bio'] = $_POST['bio'];
            }

            $f3->reroute('/hobbies');
        }
        else
        {
            //instantiate an error array with message
            if(!validEmail($_POST['em'])){
                $f3->set("errors['em']", "error: not a valid email.");
            }
            if(!validState($_POST['st'])){
                $f3->set("errors['st']", "error: not a valid state.");
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

    if (isset($_POST['in']) && !empty($_POST['in'])) {
        $_SESSION['in'] = $_POST['in'];
    }
    if (isset($_POST['out']) && !empty($_POST['out'])) {
        $_SESSION['out'] = $_POST['out'];
    }

    echo $view->render('views/profile.html');
});

//run Fat-free
$f3->run();