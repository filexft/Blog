<?php 
session_start(); 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="icon" href="logo.png" />
    <title>Fil ami Blog</title>
</head>
<body>
    
    <header>
        <div class='header'>
            <div class="logo"><img src="logo.png" width="60" height="60" alt="log"></div>
            <div class="r">Fil ami Blog</div>
            <div class="r1"></div>  
            <div class="connection"><a href="#"></a><img src="connection.png" width="23" height="23" alt="connection"></div>
        </div>
        <div class="header2">
            <div class="r2"></div>
            <div class="categorie">
                <a class="button1" href = "#"> Home</a>
                <a class="button2" href = "#"> Article</a>
                <a class="button3" href = "#"> Découvrir</a> 
            </div>
            <div class="r3"></div>
            <div class="search">
                <form action="formulaire.php" style="margin:auto;max-width:200px" method='GET' class="chercher">
                    <input type="text" placeholder="Search.." name="search" class="recherche">
                    <input type="submit" value="Chercher" class="valrecherche">
                </form>
            </div>
            
        </div>

    </header>