<?php

if ( false === ($username = file_get_contents( 'http://*** ROOT DOMAIN ***/*** API ROUTE FOR USER NAME ***/*** TOKEN FOR USER NAME ***')))
{
    $_SESSION['user'] = '';
}

$_SESSION['user'] = $username;
$_SESSION['lang'] = 'ja';
