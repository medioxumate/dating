<?php
/**
 * Created by PhpStorm.
 * @author Brian Kiehn
 * @version 1.0
 * @date 5/5/2019
 *
 */

//functions
/*
 * @param $String
 */
function validString($String)
{
    return ctype_alpha($String) AND ($String !="");
}