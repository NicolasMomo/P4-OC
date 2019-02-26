<?php

namespace Nicolas\BlogPHP\Model;

require_once("model/Manager.php");

class PostManager extends Manager
{
    public function getPosts()
    {
        $db = $this->dbConnect();
        $req = $db->query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts ORDER BY creation_date DESC LIMIT 0, 5');

        return $req;
    }

    public function getPost($postId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM posts WHERE id = ?');
        $req->execute(array($postId));
        $post = $req->fetch();

        return $post;
    }
    
        public function deletePost($id)
    {
        $db = $this->dbConnect();
        $deletedPost = $db->prepare('DELETE FROM posts WHERE id=:id');
        $deletedPost->execute(array(
        'id'=>$id
        ));
        
    }
    
    public function seePost($id)
    {
        $db = $this->dbConnect();
        $seePost = $db->prepare('SELECT id, title, content FROM posts WHERE id=:id');
        $seePost->execute(array(
            'id'=>$id
        ));
        
        return $seePost;
    }
    
    public function modifyPost($idEdit, $titleEdit, $textEdit)
    {
        $db = $this->dbConnect();
        $modifiedPost = $db->prepare('UPDDATE posts SET title=:title, content=:content WHERE id=:id');
        $modifiedPost->execute(array(
            'title'=>$titleEdit,
            'content'=>$textEdit,
            'id'=>$idEdit
        ));
    }
    
    public function addPost($titleChap,$textChap){
		$db=$this->dbConnect();
		$newChap=$db->prepare('INSERT INTO posts (title, content, creation_date) VALUES(:title,:content, NOW() )' );
		$newChap->execute(array(
			'title'=>$titleChap,
			'content'=>$textChap
		));
    }
}
