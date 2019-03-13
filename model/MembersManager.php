<?php

namespace Nicolas\BlogPHP\Model;

require_once('model/Manager.php');

class MembersManager extends Manager
{
    public function uniqueMember($member)
    {
        $db = $this->dbConnect();
        
        $actualMembers = $db->query('SELECT pseudo FROM members');
        $actualMembers = $actualMembers->fetchAll();
        $uniquePseudo = true;
        foreach($actualMembers as $dbMember){
            if (strtolower($dbMember['pseudo']) == strtolower($member->pseudo())){
                $uniquePseudo = false;
            }
        }
        return $uniquePseudo;
    }
        
    public function uniqueMail($member)
    {
       $db = $this->dbConnect();

        $actualMembers = $db->query('SELECT mail FROM members');
        $actualMembers = $actualMembers->fetchAll();
        $uniqueEmail = true; 
        foreach($actualMembers as $dbMember){
            if (strtolower($dbMember['mail']) == strtolower($member->email())){
                $uniqueEmail = false;
            }
        }
        return $uniqueEmail;
    }
    
    public function memberInscription($member)
    {
        $pass_hache = password_hash($member->pass(), PASSWORD_DEFAULT);
        
        $db = $this->dbConnect();
        
        $members = $db->prepare('INSERT INTO members(pseudo, pass, mail, inscription_date) VALUES(:pseudo, :pass, :mail, NOW())');

            $members->execute(array(
            'pseudo' => $member->pseudo(),
            'pass' => $pass_hache,
            'mail' => $member->email(),
            ));   
    }

    
    public function connectMember($pseudo, $pass)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id, pass, admin FROM members WHERE pseudo = :pseudo');
        $req->execute(array(
	       'pseudo' => $pseudo));
        $resultat = $req->fetch();
        
        $isPasswordCorrect = password_verify($pass, $resultat['pass']);
        $connectOk = false;
        
        if (!$resultat)
        {
            $_SESSION['errorConnectPseudo'] = 'Mauvais identifiant ou mot de passe !';
        }
        elseif(!$isPasswordCorrect)
        {   
            $_SESSION['errorConnectPass'] = 'Mauvais identifiant ou mot de passe !';
        }
        elseif ($isPasswordCorrect) 
            {
                session_destroy();
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['admin'] = $resultat['admin'];
                $_SESSION['pseudo'] = $pseudo;
            }
        return $connectOk;
    }
    
    public function disconnect()
    {
        session_destroy();
    }

}
