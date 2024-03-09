<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $list = [
            'Informatique',
            'Bureautique',
            'Meuble',
        ];

        foreach ($list as $name) {
            $category = new Category();
            $category->setName($name);
            $manager->persist($category); // insertion
        }

        $manager->flush();

        $category = $manager->getRepository(Category::class)->findOneBy(['name' => 'Informatique']);

        $filename = realpath('amazone_ordinateur_ok.csv');
        $file = fopen($filename, 'r');

        if ($file === false) {
            die('Fichier specialite non trouvé');
        }

        $i = 0;
        while (($row = fgets($file)) !== false) {
            if ($i != 0) {
                $data = str_getcsv($row);
                $product = new Product();
                $product->setPrice($data[1]);
                $product->setMarque($data[2]);
                $product->setModele($data[3]);
                $product->setName($product->getModele());
                $product->setSize($data[4]);
                $product->setColor($data[5]);
                $product->setDescription($data[6]);
                $product->setImage($data[7]);
                $manager->persist($product); // insertion
            }
            $i++;
        }

        $manager->flush();
        fclose($file);
    }
}
