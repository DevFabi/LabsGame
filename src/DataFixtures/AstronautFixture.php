<?php

namespace App\DataFixtures;

use App\Domain\Model\ApiToken;
use App\Domain\Model\Astronaut;
use App\Domain\Model\Planet;
use Doctrine\Bundle\FixturesBundle\Fixture;

use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AstronautFixture extends BaseFixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'planets', function($i) use ($manager) {
            $planet = new Planet($this->faker->company);
            $planet->setName($this->faker->company);
            $planet->setScore(0);
            return $planet;
        });

        $this->createMany(10, 'main_users', function($i) use ($manager) {
            $user = new Astronaut();
            $user->setUsername($this->faker->firstName);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            $apiToken1 = new ApiToken($user);
            $apiToken2 = new ApiToken($user);
            $manager->persist($apiToken1);
            $manager->persist($apiToken2);
            return $user;
        });
        $this->createMany(3, 'admin_users', function($i) {
            $user = new Astronaut();
            $user->setUsername($this->faker->firstName);
            $user->setRoles(['ROLE_ADMIN']);
            $user->setPassword($this->passwordEncoder->encodePassword(
                $user,
                'engage'
            ));
            return $user;
        });
        $manager->flush();
    }
}
