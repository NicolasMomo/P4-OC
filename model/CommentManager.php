<?php

namespace Nicolas\BlogPHP\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
    public function getComments($postId)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('SELECT id, author, comment, DATE_FORMAT(comment_date, \'%d/%m/%Y à %Hh%imin%ss\') AS comment_date_fr FROM comments WHERE post_id = ? ORDER BY comment_date DESC');
        $comments->execute(array($postId));

        return $comments;
    }

    public function postComment($postId, $author, $comment)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $comment));

        return $affectedLines;
    }
    
    public function reportComment($id)
    {
        $db = $this->dbConnect();
        $reportComment = $db->prepare('UPDATE comments SET reported=1 where id=:id');
        $reportComment->execute(array(
        'id'=>$id
        ));
    }
    
    public function autoriseComment($id)
    {
        $db = $this->dbConnect();
        $autoriseComment = $db->prepare('UPDATE comments SET reported=0 where id=:id');
        $autoriseComment->execute(array(
        'id'=>$id
        ));
    }
    
    public function deleteComment($id)
    {
        $db = $this->dbConnect();
        $delete = $db->prepare('DELETE FROM comments WHERE id=:id');
        $delete->execute(array(
        'id'=>$id
        ));
    }

}
