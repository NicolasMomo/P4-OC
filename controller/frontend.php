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
