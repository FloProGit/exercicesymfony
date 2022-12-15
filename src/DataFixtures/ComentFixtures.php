<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ComentFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        dd('patate');
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
