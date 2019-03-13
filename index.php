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
            addMember(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['pass']), htmlspecialchars($_POST['confirmPass']), htmlspecialchars($_POST['email']));
        }
        elseif ($_GET['action'] == 'connectMember'){
            connectMember($_POST['userName'], $_POST['pass']);
        }
        elseif($_GET['action'] == 'disconnectMember'){
          disconnect();  
        }
        //COMMENTS
        elseif ($_GET['action'] == 'reportComment'){
            reportComment($_GET['id'], $_GET['postId']);
        }
        elseif ($_GET['action'] == 'autoriseComment'){
            autoriseComment($_GET['id']);
        }
        elseif ($_GET['action'] == 'deleteComment'){
            deleteComment($_GET['id']);
        }
        elseif ($_GET['action'] == 'seeReported'){
            if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
            {
                listReportedComments();
            }
            else{
                listPosts();
            }
        }
        //REDIRECT
        elseif ($_GET['action'] == 'connectForm'){
            connectForm();
        }
        elseif ($_GET['action'] == 'inscriptionForm'){
            inscriptionForm();
        }
        //POSTS
        elseif ($_GET['action'] == 'postsAsc'){
            listPostsAsc();
        }
        elseif ($_GET['action'] == 'seePost'){
            if (isset($_SESSION['admin']) AND $_SESSION['admin'] == 1)
            {
                seePost($_GET['id']);
            }
            else{
                listPosts();
            }
        }
        elseif($_GET['action'] == 'addPost'){
            addPost($_POST['title'], $_POST['tinymce_Chap']);
        }
        elseif ($_GET['action'] == 'deletePost'){
            deletePost($_GET['id']);
        }
        elseif ($_GET['action'] == 'modifyPost'){
            modifyPost($_GET['id'], $_POST['title'], $_POST['tinymce_Chap']);
        }
    }
    else {
        listPosts();
    }
}
catch(Exception $e) { // S'il y a eu une erreur, alors...
    echo 'Erreur : ' . $e->getMessage();
}
