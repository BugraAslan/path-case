<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    /** @var UserPasswordEncoderInterface */
    protected $encoder;

    /**
     * AppFixtures constructor.
     * @param UserPasswordEncoderInterface $encoder
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (['adidas', 'nike', 'skechers'] as $company){
            $clientEntity = new Client();
            $clientEntity
                ->setName($company)
                ->setUsername($company)
                ->setPassword($this->encoder->encodePassword($clientEntity, $company))
                ->setStatus(1);

            $manager->persist($clientEntity);
        }

        $manager->flush();
    }
}