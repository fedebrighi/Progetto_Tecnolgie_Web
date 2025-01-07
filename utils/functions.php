<?php
    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF'])==$pagename){
            echo " class='active' ";
        }
    }
    function isUserLoggedIn(){
        return !empty($_SESSION['idutente']);
    }

?>