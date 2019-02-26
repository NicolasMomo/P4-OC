<?php

namespace Nicolas\BlogPHP\Model;

require_once('model/Manager.php');

class MembersManager extends Manager
{
	public function inscriptionMember($member)
	{
		$pass_hache = password_hash($member->pass(), PASSWORD_DEFAULT);

		$db = $this->dbConnect();

        $actualMembers = $db->query('SELECT pseudo, mail FROM members');
        $actualMembers = $actualMembers->fetchAll();
        $uniquePseudo = true;
        $uniqueEmail = true;
        foreach($actualMembers as $dbMember){
            if ($dbMember['pseudo'] == $member->pseudo()){
                $uniquePseudo = false;
                $_SESSION['errorPseudo'] = 'Ce pseudo est déjà utilisé';
                header('location: ../architecture MVC/view/frontend/inscription.php');
            }
            if ($dbMember['mail'] == $member->email()){
                $uniqueEmail = false;
                $_SESSION['errorMail'] = 'Cette adresse mail est déjà utilisée';
                header('location: ../architecture MVC/view/frontend/inscription.php');
            }
        }
        if ($uniqueEmail AND $uniquePseudo){
           	$members = $db->prepare('INSERT INTO members(pseudo, pass, mail, inscription_date) VALUES(:pseudo, :pass, :mail, NOW())');

            $members->execute(array(
            'pseudo' => $member->pseudo(),
            'pass' => $pass_hache,
            'mail' => $member->email(),
            ));
            
            header('Location: index.php');
        }
	}
    
    public function connectMember($pseudo, $pass)
    {
        $db = $this->dbConnect();
        
        $req = $db->prepare('SELECT id, pass, admin FROM members WHERE pseudo = :pseudo');
        $req->execute(array(
	       'pseudo' => $pseudo));
        $resultat = $req->fetch();
        
        $isPasswordCorrect = password_verify($pass, $resultat['pass']);
        
        if (!$resultat)
        {
            
            $_SESSION['errorConnectPseudo'] = 'Mauvais identifiant ou mot de passe !';
            header('location: ../architecture MVC/view/frontend/connexion.php');
        }
        elseif(!$isPasswordCorrect)
        {
            
            $_SESSION['errorConnectPass'] = 'Mauvais identifiant ou mot de passe !';
            header('location: ../architecture MVC/view/frontend/connexion.php');
        }
        elseif ($isPasswordCorrect) 
            {
                session_destroy();
                session_start();
                $_SESSION['id'] = $resultat['id'];
                $_SESSION['admin'] = $resultat['admin'];
                $_SESSION['pseudo'] = $pseudo;
                header('Location: index.php');
            }
    }
    
    public function disconnect()
    {
        session_destroy(); //destroy the session
        header("location: index.php"); //to redirect back to "index.php" after logging out
        exit();
    }
    
    public function connectForm()
    {
        header('Location: view/frontend/connexion.php');
    }
    
    public function inscriptionForm()
    {
        header('Location: view/frontend/inscription.php');
    }

}
