<?php

namespace App\DataFixtures;

use App\Entity\Pet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('userbis@doctopet.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('userbisfirstname');
        $user->setLastname('userlbisastname');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userbispassword'
        ));

        $userpet = new Pet();
        $userpet->setName('userbispanda');
        $userpet->setHappiness(50);
        $userpet->setHealth(30);
        $userpet->setUser($user);
        $userpet->setHasPills(0);
        $manager->persist($userpet);

        $user->setPet($userpet);

        $manager->persist($user);

        $admin = new User();
        $admin->setEmail('adminbis@doctopet.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('adminbisfirstname');
        $admin->setLastname('adminbislastname');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminbispassword'
        ));

        $adminpet = new Pet();
        $adminpet->setName('adminbispanda');
        $adminpet->setHappiness(50);
        $adminpet->setHealth(30);
        $adminpet->setUser($admin);
        $adminpet->setHasPills(0);

        $manager->persist($adminpet);

        $admin->setPet($adminpet);

        $manager->persist($admin);

        $manager->flush();
    }
}
