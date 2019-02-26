<?php

// Chargement des classes

require_once('model/PostManager.php');
require_once('model/CommentManager.php');
require_once('model/MembersManager.php');
require_once('model/entities/member.php');

/** Posts Manage **/

function listPosts()
{
    $postManager = new \Nicolas\BlogPHP\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts(); // Appel d'une fonction de cet objet

    require('view/frontend/listPostsView.php');
}

function post($id)
{
    $postManager = new \Nicolas\BlogPHP\Model\PostManager();
    $commentManager = new \Nicolas\BlogPHP\Model\CommentManager();

    $post = $postManager->getPost($id);
    $comments = $commentManager->getComments($id);

    require('view/frontend/postView.php');
}

/** Comments Manage **/

function addComment($postId, $author, $comment)
{
    $commentManager = new \Nicolas\BlogPHP\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}

function reportComment($id, $postId)
{
    $reportComment = new \Nicolas\BlogPHP\Model\CommentManager();
    $report = $reportComment->reportComment($id);
    post($postId);
}

function listReportedComments()
{
    $reportedComments = new \Nicolas\BlogPHP\Model\CommentManager();
    $reported = $reportedComments->getReportedComments();
    
    $postManager = new \Nicolas\BlogPHP\Model\PostManager(); // Création d'un objet
    $posts = $postManager->getPosts();
    
    require('view/frontend/connectAdmin.php');
}

function autoriseComment($id)
{
    $autoriseComment = new \Nicolas\BlogPHP\Model\CommentManager();
    $autorise = $autoriseComment->autoriseComment($id);
}

function deleteComment($id)
{
    $deleteComment = new \Nicolas\BlogPHP\Model\CommentManager();
    $delete = $deleteComment->deleteComment($id); 
}

/** Members Manage **/

function addMember($pseudo, $pass, $confirmPass, $mail)
{
    $newMember = new Member(NULL, $pseudo, $pass, $confirmPass, $mail); 
    if (empty($newMember->errors())){
        $memberManager = new \Nicolas\BlogPHP\Model\MembersManager();
        $member = $memberManager->inscriptionMember($newMember);
    }
    else{
        header('Location: view/frontend/inscription.php');
    }
}

function connectMember($pseudo, $pass)
{
    $connectMember = new \Nicolas\BlogPHP\Model\MembersManager();
    $connectMember->connectMember($pseudo, $pass);
}

function disconnect()
{
    $disconnectMember = new \Nicolas\BlogPHP\Model\MembersManager();
    $disconnect = $disconnectMember->disconnect();
}

function connectForm()
{
    $connectForm = new \Nicolas\BlogPHP\Model\MembersManager();
    $formConnect = $connectForm->connectForm();
}

function inscriptionForm()
{
    $inscriptionForm = new \Nicolas\BlogPHP\Model\MembersManager();
    $formInscription = $inscriptionForm->connectForm();
}
