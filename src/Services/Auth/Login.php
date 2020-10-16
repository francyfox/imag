<?php


namespace App\Services\Auth;

use DocRep\Agent;
use http\Env\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\Validator\Constraints as SecurityAssert;



class Login
{
    /**
     * @Assert\Type(type="DocRep\Agent")
     */

    private $AgentPassword;

    private $password;


    public function getAgentPassword(Agent $user)
    {
        $this->AgentPassword = $user->getPassword();
    }

    /**
     * @param int $id
     * @param string $password
     * @Assert\IsTrue(message="The password is invalid.")
     */

    public function isPassValid(int $id, string $password)
    {

    }



}