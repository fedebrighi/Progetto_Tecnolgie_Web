<?php
function isActive($pagename)
{
    if (strpos($_SERVER['PHP_SELF'], $pagename) !== false) {
        echo " class='active' ";
    }
}
function getIdFromName($name)
{
    return preg_replace("/[^a-z]/", '', strtolower($name));
}

function isUserLoggedIn()
{
    return !empty($_SESSION['username']);
}

function registerLoggedUser($user)
{
    $_SESSION["username"] = $user["username"];
    $_SESSION["pw"] = $user["pw"];
}

function getAction($action)
{
    $result = "";
    switch ($action) {
        case 1:
            $result = "Inserisci";
            break;
        case 2:
            $result = "Modifica";
            break;
        case 3:
            $result = "Cancella";
            break;
    }

    return $result;
}
