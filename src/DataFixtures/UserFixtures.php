<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends BaseFixture
{
//    public function load(ObjectManager $manager)
//    {
//        // $product = new Product();
//        // $manager->persist($product);
//
//        $manager->flush();
//    }

    private $userPasswordEncoder;


    /**
     * UserFixtures constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(10, 'main_users', function ($i){

            $user = new User();
            $user->setEmail(sprintf('alameda%d@example.com', $i));
            $user->setPrimerNombre($this->faker->firstName);
            $user->setPassword($this->userPasswordEncoder->encodePassword(
                $user,
                'Ninguna'
            ));

            return $user;

        });

        $manager->flush();
    }
}
