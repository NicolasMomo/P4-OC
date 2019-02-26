<?php
session_start();

require('controller/frontend.php');

try { // On essaie de faire des choses
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'listPosts') {
            listPosts();
        }
        elseif ($_GET['action'] == 'post') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                post($_GET['id']);
            }
            else {
                // Erreur ! On arrête tout, on envoie une exception, donc au saute directement au catch
                throw new Exception('Aucun identifiant de billet envoyé');
            }
        }
        elseif ($_GET['action'] == 'addComment') {
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                if (!empty($_POST['author']) && !empty($_POST['comment'])) {
                    addComment($_GET['id'], $_POST['author'], $_POST['comment']);
                }
                else {
                    // Autre exception
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
            }
        //MEMBERS
        elseif ($_GET['action'] == 'addMember') {
            addMember($_POST['pseudo'], $_POST['pass'], $_POST['confirmPass'], $_POST['email']);
        }
        elseif ($_GET['action'] == 'connectMember'){
            connectMember($_POST['userName'], $_POST['pass']);
        }
        elseif($_GET['action'] == 'disconnectMember'){
          disconnect();  
        }
        //REDIRECT
        elseif ($_GET['action'] == 'connectForm'){
            connectForm();
        }
        elseif ($_GET['action'] == 'inscriptionForm'){
            inscriptionForm();
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
