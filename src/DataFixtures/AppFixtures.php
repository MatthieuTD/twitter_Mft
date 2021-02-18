<?php

namespace App\DataFixtures;

use App\Entity\Tweet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encode = $encoder;
    }
    public function load( ObjectManager $manager)
    {
        $passwordEncoder = $this->encode;
        $listUser = [
            "matthieu",
            "simon",
            "fabricio",
            "tristana",
            "ina"
        ];
        $listTweet = [
            "Ina à deux maitres en OR",
            "Ma chaussette est au lave linge",
            "Fabrice l'étalon blanc",
            "Vive le Bitcoin",
            "Vive l'Irish coffe",
            "Matthieu LE MEC CHAUD",
            "Tristan le REACTMAN",

        ];

        foreach ($listUser as $user_name){
            $user= new User();
            $user->setName($user_name);
            $user->setEmail("$user_name@test.fr");
            $encoded = $passwordEncoder->encodePassword($user, $user_name);
            $user->setPassword($encoded);
            $manager->persist($user);




            foreach ($listTweet as $text){
                $tweet = new Tweet();
                $tweet->setUser($user);
                $tweet->setText($text);
                $user->addTweet($tweet);
                $manager->persist($tweet);
            }
//gestion follow


        }
        $manager->flush();





        $follow_user = $manager->getRepository(User::class)
            ->findOneBy(['name' => 'simon']);

        $follow_user1 =
            $manager->getRepository(User::class)
            ->findOneBy(['name' => 'fabricio']);

        $follow_user->addFollower($follow_user1);

        $follow_user = $manager->getRepository(User::class)
            ->findOneBy(['name' => 'tristana']);

        $follow_user1 =
            $manager->getRepository(User::class)
                ->findOneBy(['name' => 'matthieu']);

        $follow_user->addFollower($follow_user1);

        $follow_user = $manager->getRepository(User::class)
            ->findOneBy(['name' => 'simon']);

        $follow_user1 =
            $manager->getRepository(User::class)
                ->findOneBy(['name' => 'matthieu']);

        $follow_user->addFollower($follow_user1);

        $manager->flush();
    }
}
