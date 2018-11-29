<?php

session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: signin"); // Redirecting To Home Page
}
?>