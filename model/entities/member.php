<?php

class Member
{
	private $_id, $_pseudo, $_pass, $_mail, $_errors=[];
    
    public function __construct($id, $pseudo, $pass, $confirmPass, $mail)
    {
        $this->setId($id);
        $this->setPseudo($pseudo);
        $this->setPass($pass, $confirmPass);
        $this->setEmail($mail);
    }

	public function setId($id)
	{
		$id = (int) $id;
		if ($id > 0)
		{
			$this->_id = $id;
		}
	}

	public function setPseudo($pseudo)
	{
        if(is_string($pseudo) AND (!empty($pseudo)))
            {
                $this->_pseudo = $pseudo;
            }
	}

	public function setPass($pass, $confirmPass)
	{
		if (!empty($pass) AND is_string($pass) AND $pass == $confirmPass)
			{
				$this->_pass = $pass;
			}
        else 
        {
           $this->_errors = 'Les deux mots de passes ne correspondent pas';
            $_SESSION['errorPass'] = 'Les deux mots de passes ne correspondent pas';
        }
	}
    
	public function setEmail($mail)
	{
		if (preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#', $mail))
		{
			$this->_mail = $mail;
		}
        else
        {
            $this->_errors = 'Adresse mail incorrecte';
            $_SESSION['errorMail'] = 'Adresse mail incorrecte';
        }
	}

    
    
    public function id()
    {
        return $this->_id;
    }
    
    public function pseudo()
    {
        return $this->_pseudo;
    }
    
    public function pass()
    {
        return $this->_pass;
    }
    

    public function email()
    {
        return $this->_mail;
    }
    
	
    public function errors()
    {
      return $this->_errors; 
    }
        
}
