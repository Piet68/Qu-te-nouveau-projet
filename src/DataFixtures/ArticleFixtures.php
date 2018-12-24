<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
//use Symfony\Bundle\FrameworkBundle\Tests\Fixtures\Validation\Article;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{


    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i < 50; $i++){
            $article = new Article();
            $article->setTitle(mb_strtolower($faker->sentence($nbWords = 6, $variableNbWords = true)));
            $article->setContent($faker->paragraph($nbSentences = 3, $variableNbSentences = true));

            $manager->persist($article);
            $article->setCategory($this->getReference('categorie_'.rand(0,4)));
        }

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {

        return [CategoryFixtures::class];

    }
}
