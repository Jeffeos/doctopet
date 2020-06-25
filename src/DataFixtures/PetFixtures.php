<?php

namespace App\DataFixtures;

use App\Entity\Pet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PetFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {

        $user = new User();
        $user->setEmail('user@doctopet.fr');
        $user->setRoles(['ROLE_USER']);
        $user->setFirstname('userfirstname');
        $user->setLastname('userlastname');
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'userpassword'
        ));

        $manager->persist($user);

        $userpet = new Pet();
        $userpet->setName('userpanda');
        $userpet->setHappiness(50);
        $userpet->setHealth(30);
        $userpet->setUser($user);
        $userpet->setHasPills(0);

        $manager->persist($userpet);

        $admin = new User();
        $admin->setEmail('admin@doctopet.fr');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setFirstname('adminfirstname');
        $admin->setLastname('adminlastname');
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adminpassword'
        ));

        $manager->persist($admin);

        $adminpet = new Pet();
        $adminpet->setName('adminpanda');
        $adminpet->setHappiness(50);
        $adminpet->setHealth(30);
        $adminpet->setUser($admin);
        $adminpet->setHasPills(0);

        $manager->persist($adminpet);

        $manager->flush();
    }
}
