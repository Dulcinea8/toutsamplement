<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Entity\Tracks;
class TestData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artistes=[
        	['nom'=>'2Pac', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
        	['nom'=>'Joe Cocker', 'user'=>null, 'genre'=>'Rock', 'article'=>null],
        ];

        

        foreach($artistes as $artiste) { 
        	$test= new Artistes();
        	$test->setNom($artiste['nom']);
        	$test->setUser($artiste['user']);
        	$test->setGenre($artiste['genre']);
        	$test->setArticle($artiste['article']);
        	$manager->persist($test);

        	$this->addReference($artiste['nom'], $test);
        }

        $albums=[
        	['idartiste'=>$this->getReference('2Pac'), 'nom'=>'All Eyez on Me', 'annee'=>'1995', 'pochette' =>null],
        	['idartiste'=>$this->getReference('Joe Cocker'), 'nom'=>'Joe Cocker album', 'annee'=>'1972', 'pochette' =>null]
        ];

        foreach($albums as $album) { 
        	$test= new Albums();
        	$test->setIdartiste($album['idartiste']);
        	$test->setNom($album['nom']);
        	$test->setAnnee($album['annee']);
        	$test->setPochette($album['pochette']);
        	
        	$manager->persist($test);

        	$this->addReference($album['nom'], $test);
        }

        $tracks=[
        	['idalbum'=>$this->getReference('All Eyez on Me'),'isvalidated'=>1, 'titre'=>'California Love', 'lien'=>'yolo', 'date_publi'=> null],
        	['idalbum'=>$this->getReference('Joe Cocker album'),'isvalidated'=>1, 'titre'=>'Woman to Woman', 'lien'=>'yolo', 'date_publi'=> null],
    	];


    	foreach($tracks as $track) { 
        	$test= new Tracks();
        	$test->setIdalbum($track['idalbum']);
        	$test->setTitre($track['titre']);
        	$test->setIsValidated($track['isvalidated']);
        	$test->setLien($track['lien']);
        	$test->setDatePubli($track['date_publi']);
        	
        	$manager->persist($test);

        	$this->addReference($track['titre'], $test);
        }

        $manager->flush();



        // $sample->setIdartiste_id($this->getReference('2Pac'));
    }
}
