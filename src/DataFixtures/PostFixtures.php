<?php

namespace App\DataFixtures;

use App\Entity\Post;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PostFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $post = new Post;
            $post->setTitle($faker->words(rand(3,10), true))
                ->setDescription($faker->paragraphs(rand(2, 10), true))
                ->setAuthor($faker->firstname())
                ->setImage('http://placeimg.com/30'.$i.'/300/any')
                ->setUser($this->getReference('user' . rand(0, 9)));
            
            for($j = 0; $j < rand(1, 3); $j++) {
                $post->addCategory($this->getReference('category' . rand(0, 4)));
            }
                
            $this->addReference('post' . $i, $post);
            $manager->persist($post);
        }

        for($i = 0; $i < 50; $i++) {
            $comment = new Comment;
            $comment->setContent($faker->paragraphs(rand(2, 10), true));
            $comment->setAuthor($this->getReference('user' . rand(0, 9)));
            $comment->setPost($this->getReference('post' . rand(0, 9)));
            $manager->persist($comment);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
            UserFixtures::class
        ];
    }
}
