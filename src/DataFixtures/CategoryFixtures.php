<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
//use Proxies\__CG__\App\Entity\Category;

class CategoryFixtures extends Fixture
{
    private $categories = [
        'PHP',
        'Java',
        'Javascript',
        'Ruby',
        'DevOps'
    ];



    public function load(ObjectManager $manager)
    {
        foreach ($this->categories as $key => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('categorie_' . $key, $category);
        }
        $manager->flush();
    }
}
