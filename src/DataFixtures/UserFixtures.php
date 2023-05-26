<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('Jeanmontaingne@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->hashPassword($user, 'montaingne'));
        $user->setName('Jean');
        $user->setFirstname('Montaingne');
        $manager->persist($user);

        $user2 = new User();
        $user2->setEmail('bernard@gmail.com');
        $user2->setPassword($this->passwordEncoder->hashPassword($user2, 'henry'));
        $user2->setName('Bernard');
        $user2->setFirstname('Henry');
        $manager->persist($user2);

        $manager->flush();
    }
}
?>