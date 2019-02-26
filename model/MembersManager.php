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

}
