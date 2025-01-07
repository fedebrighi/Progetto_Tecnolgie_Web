<?php
    function isActive($pagename){
        if(basename($_SERVER['PHP_SELF'])==$pagename){
            echo " class='active' ";
        }
    }
    function getIdFromName($name){
        return preg_replace("/[^a-z]/", '', strtolower($name));
    }

    function isUserLoggedIn(){
        return !empty($_SESSION['idautore']);
    }

    function registerLoggedUser($user){
        $_SESSION["idautore"] = $user["idautore"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["nome"] = $user["nome"];
    }

    function getEmptyArticle(){
        return array("idarticolo" => "", "titoloarticolo" => "", "imgarticolo" => "", "testoarticolo" => "", "anteprimaarticolo" => "", "categorie" => array());
    }

    function getAction($action){
        $result = "";
        switch($action){
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