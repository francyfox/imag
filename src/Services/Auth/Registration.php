<?php


namespace App\Services\Auth;

use DocRep\Agent;
use Symfony\Component\Validator\Constraints as Assert;

class Registration
{
    /**
     * @Assert\Type(type="DocRep\Agent")
     */
    protected $user;

    protected $termsAccepted;

    protected $plain;


    public function setUser(Agent $user)
    {
        $this->user = $user;
        $this->plain = $user->getPassword();
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function getPlain()
    {
        return $this->plain;
    }

    public function setHashPassword($hashPassword): void
    {
        $this->user->setPassword($hashPassword);
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (bool) $termsAccepted;
    }
}