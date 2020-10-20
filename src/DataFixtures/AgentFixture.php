<?php

namespace App\DataFixtures;

use DocRep\Agent as agent;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class AgentFixture extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new agent();
        $user->setEmail('admin@sym.com');
        $user->setPassword(
            $this->encoder->encodePassword($user, '0000')
        );

        $manager->persist($user);
        $manager->flush();
    }
}
