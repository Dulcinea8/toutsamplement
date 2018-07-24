<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Entity\Tracks;
use App\Entity\Articles;
use App\Entity\Users;
class TestData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $artistes=[
        	['nom'=>'2Pac', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
        	['nom'=>'Joe Cocker', 'user'=>null, 'genre'=>'Rock', 'article'=>null],
            ['nom'=>'Dr. Dre', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'David McCallum', 'user'=>null, 'genre'=>'Soul', 'article'=>null],
            ['nom'=>'113', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'Curtis Mayfield', 'user'=>null, 'genre'=>'Soul', 'article'=>null],
            ['nom'=>'Justice', 'user'=>null, 'genre'=>'Electro', 'article'=>null],
            ['nom'=>'The Brothers Johnson', 'user'=>null, 'genre'=>'Soul', 'article'=>null],
            ['nom'=>'The Notorious B.I.G.', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'Diana Ross', 'user'=>null, 'genre'=>'Soul', 'article'=>null],
            ['nom'=>'Daft Punk', 'user'=>null, 'genre'=>'Electro', 'article'=>null],
            ['nom'=>'Eddie Johns', 'user'=>null, 'genre'=>'Disco', 'article'=>null],
            ['nom'=>'Scred Connexion', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'Kentarō Haneda', 'user'=>null, 'genre'=>'Générique', 'article'=>null],
            ['nom'=>'Passi', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'Barry De Vorzon', 'user'=>null, 'genre'=>'Générique', 'article'=>null],
            ['nom'=>'Black Eyed Peas', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'Dick Dale', 'user'=>null, 'genre'=>'Rock', 'article'=>null],
            ['nom'=>'A Tribe Called Quest', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null],
            ['nom'=>'Lou Reed', 'user'=>null, 'genre'=>'Rock', 'article'=>null]
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
        	['idartiste'=>$this->getReference('2Pac'), 'nom'=>'All Eyez on Me', 'annee'=>'1995', 'pochette' =>'https://static.fnac-static.com/multimedia/Images/FR/NR/f8/65/27/2582008/1539-6/tsp20130830053831/All-eyez-on-me-remasterise.jpg'],
        	['idartiste'=>$this->getReference('Joe Cocker'), 'nom'=>'Joe Cocker album', 'annee'=>'1972', 'pochette' =>'https://static.fnac-static.com/multimedia/Images/FR/NR/5d/4a/23/2312797/1540-1/tsp20170928164521/The-best-of.jpg'],
            ['idartiste'=>$this->getReference('Dr. Dre'), 'nom'=>'Chronic 2001', 'annee'=>'1999', 'pochette' =>'https://static.fnac-static.com/multimedia/Images/FR/NR/49/99/0a/694601/1539-6/tsp20130901165640/Chronic-2001.jpg'],
            ['idartiste'=>$this->getReference('David McCallum'), 'nom'=>'Music: A Bit More of Me', 'annee'=>'1967', 'pochette' =>'https://static.fnac-static.com/multimedia/Images/FR/NR/09/1c/32/3283977/1539-1/tsp20170928211555/Music-a-bit-more-of-me.jpg'],
            ['idartiste'=>$this->getReference('113'), 'nom'=>'Les Princes De La Ville album', 'annee'=>'1999', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/51SGMCEYKKL.jpg'],
            ['idartiste'=>$this->getReference('Curtis Mayfield'), 'nom'=>'Sweet Exorcist', 'annee'=>'1974', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/61SpjOK%2BtXL.jpg'],
            ['idartiste'=>$this->getReference('Justice'), 'nom'=>'Cross', 'annee'=>'2007', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/71fP821BY8L._SX522_.jpg'],
            ['idartiste'=>$this->getReference('The Brothers Johnson'), 'nom'=>'Light Up the Night', 'annee'=>'1980', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/41J117MNDWL.jpg'],
            ['idartiste'=>$this->getReference('The Notorious B.I.G.'), 'nom'=>'Life After Death', 'annee'=>'1997', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/71-QUlvAlBL._SL1400_.jpg'],
            ['idartiste'=>$this->getReference('Diana Ross'), 'nom'=>'Diana', 'annee'=>'1980', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/81ZC66f5gFL._SL1400_.jpg'],
            ['idartiste'=>$this->getReference('Daft Punk'), 'nom'=>'Discovery', 'annee'=>'2000', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/410UITi3BhL._SS500.jpg'],
            ['idartiste'=>$this->getReference('Eddie Johns'), 'nom'=>'More Spell on You album', 'annee'=>'1979', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/51aB87FxCkL._SS500.jpg'],
            ['idartiste'=>$this->getReference('Scred Connexion'), 'nom'=>'Scred Selexion 99/2000', 'annee'=>'2000', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/51au8w3gkAL._SS500.jpg'],
            ['idartiste'=>$this->getReference('Kentarō Haneda'), 'nom'=>'Space Cobra', 'annee'=>'1982', 'pochette' =>'https://images-na.ssl-images-amazon.com/images/I/61LDGqm6JbL.jpg'],
            ['idartiste'=>$this->getReference('Passi'), 'nom'=>'Les Tentations', 'annee'=>'1998', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/51gAUqPDe5L._SS500.jpg'],
            ['idartiste'=>$this->getReference('Barry De Vorzon'), 'nom'=>'Nadia\'s Theme album', 'annee'=>'1973', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/5147PutAyYL._SS500.jpg'],
            ['idartiste'=>$this->getReference('Black Eyed Peas'), 'nom'=>'Monkey Business', 'annee'=>'2005', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/61-MuHZZTkL._SS500.jpg'],
            ['idartiste'=>$this->getReference('Dick Dale'), 'nom'=>'Deltone', 'annee'=>'1962', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/51lIjnodrBL._SS500.jpg'],
            ['idartiste'=>$this->getReference('A Tribe Called Quest'), 'nom'=>'People\'s Instinctive Travels and the Paths of Rhythm', 'annee'=>'1990', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/615qpr0HpHL._SS500.jpg'],
            ['idartiste'=>$this->getReference('Lou Reed'), 'nom'=>'Transformer', 'annee'=>'1972', 'pochette' =>'https://images-eu.ssl-images-amazon.com/images/I/51zy0FjR1TL._SS500.jpg']


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
        	['idalbum'=>$this->getReference('All Eyez on Me'),'isvalidated'=>1, 'titre'=>'California Love', 'lien'=>'https://www.youtube.com/watch?v=5wBTdfAkqGU', 'date_publi'=> '2018-07-23'],
        	['idalbum'=>$this->getReference('Joe Cocker album'),'isvalidated'=>1, 'titre'=>'Woman to Woman', 'lien'=>'https://www.youtube.com/watch?v=9UC3y5QYJ_4', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Chronic 2001'),'isvalidated'=>1, 'titre'=>'The Next Episode', 'lien'=>'https://www.youtube.com/watch?v=QZXc39hT8t4', 'date_publi'=> '2018-07-22'],
            ['idalbum'=>$this->getReference('Music: A Bit More of Me'),'isvalidated'=>1, 'titre'=>'The Edge', 'lien'=>'https://www.youtube.com/watch?v=6pG_3jZxzlo', 'date_publi'=> '2018-07-22'],
            ['idalbum'=>$this->getReference('Les Princes De La Ville album'),'isvalidated'=>1, 'titre'=>'Les Princes De La Ville', 'lien'=>'https://www.youtube.com/watch?v=EdyzIh0to1c', 'date_publi'=> '2018-07-21'],
            ['idalbum'=>$this->getReference('Sweet Exorcist'),'isvalidated'=>1, 'titre'=>'Make Me Believe in You', 'lien'=>'https://www.youtube.com/watch?v=fexIgzfOAiE', 'date_publi'=> '2018-07-21'],
            ['idalbum'=>$this->getReference('Cross'),'isvalidated'=>1, 'titre'=>'Newjack', 'lien'=>'https://www.youtube.com/watch?v=9f-NQZYCZnA', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Light Up the Night'),'isvalidated'=>1, 'titre'=>'You Make Me Wanna Wiggle', 'lien'=>'https://www.youtube.com/watch?v=bQ8TCpaw4m0', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Life After Death'),'isvalidated'=>1, 'titre'=>'Mo Money Mo Problems', 'lien'=>'https://www.youtube.com/watch?v=VAOUbr2HEpo', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Diana'),'isvalidated'=>1, 'titre'=>'I\'m Coming Out', 'lien'=>'https://www.youtube.com/watch?time_continue=322&v=zbYcte4ZEgQ', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Discovery'),'isvalidated'=>1, 'titre'=>'One More Time', 'lien'=>'https://www.youtube.com/watch?v=FGBhQbmPwH8', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('More Spell on You album'),'isvalidated'=>1, 'titre'=>'More Spell on You', 'lien'=>'https://www.youtube.com/watch?time_continue=230&v=53p7ogqJqqs', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Scred Selexion 99/2000'),'isvalidated'=>1, 'titre'=>'Scred Connexion Feat Fabe', 'lien'=>'https://www.youtube.com/watch?v=uM9ZM1Jgs7k', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Space Cobra'),'isvalidated'=>1, 'titre'=>'Shi No Kōshin', 'lien'=>'https://www.youtube.com/watch?v=37FCzjAvdE0', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Les Tentations'),'isvalidated'=>1, 'titre'=>'Je Zappe Et Je Mate', 'lien'=>'https://www.youtube.com/watch?v=HRLmmnzbQHE', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Nadia\'s Theme album'),'isvalidated'=>1, 'titre'=>'Nadia\'s Theme', 'lien'=>'https://www.youtube.com/watch?time_continue=2&v=Vlv32UEazGc', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Monkey Business'),'isvalidated'=>1, 'titre'=>'Pump It', 'lien'=>'https://www.youtube.com/watch?v=ZaI2IlHwmgQ', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Deltone'),'isvalidated'=>1, 'titre'=>'Miserlou', 'lien'=>'https://www.youtube.com/watch?time_continue=5&v=qJmI6fAPUSk', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('People\'s Instinctive Travels and the Paths of Rhythm'),'isvalidated'=>1, 'titre'=>'Can I Kick It?', 'lien'=>'https://www.youtube.com/watch?v=7D_JwgIM-y4', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Transformer'),'isvalidated'=>1, 'titre'=>'Walk on the Wild Side', 'lien'=>'https://www.youtube.com/watch?time_continue=4&v=oG6fayQBm9w', 'date_publi'=> '2018-07-23']
    	];


    	foreach($tracks as $track) { 
        	$test= new Tracks();
        	$test->setIdalbum($track['idalbum']);
        	$test->setTitre($track['titre']);
        	$test->setIsValidated($track['isvalidated']);
        	$test->setLien($track['lien']);
        	$test->setDatePubli(new \DateTime($track['date_publi']));
        	
        	$manager->persist($test);

        	$this->addReference($track['titre'], $test);
        }

        

$users=[
            ['username'=>'Tooty', 'nom'=>'Lemarchand', 'prenom'=>'Julien', 'email'=>'jl.julienlemarchand@gmail.com', 'password'=>'Julien83', 'avatar'=>null, 'date_inscription'=>'2018-07-23', 'score'=>3, 'facebook'=>null, 'soundcloud'=>null, 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']],
            ['username'=>'Fellez', 'nom'=>'Marchand', 'prenom'=>'Benjamin', 'email'=>'bejimarch@gmail.com', 'password'=>'Error404', 'avatar'=>'https://f4.bcbits.com/img/a1813742944_16.jpg', 'date_inscription'=>'2018-07-20', 'score'=>1, 'facebook'=>'https://www.facebook.com/FellezBdx/', 'soundcloud'=>'https://soundcloud.com/ben-march-1', 'bandcamp'=>'https://err404.bandcamp.com/album/larbre-et-la-pirogue', 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_USER']],
            ['username'=>'Aoced', 'nom'=>'Arnaudet', 'prenom'=>'Cédric', 'email'=>'aoced33@gmail.com', 'password'=>'Araratbx33', 'avatar'=>'https://i.vimeocdn.com/portrait/17533011_300x300', 'date_inscription'=>'2018-07-21', 'score'=>3, 'facebook'=>null, 'soundcloud'=>'https://soundcloud.com/robin-master', 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']],
            ['username'=>'dulcine', 'nom'=>'Cadic', 'prenom'=>'Dulce', 'email'=>'dulce.cesar263@gmail.com', 'password'=>'1985Arcachon', 'avatar'=>null, 'date_inscription'=>'2018-07-21', 'score'=>3, 'facebook'=>null, 'soundcloud'=>null, 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']],
            ['username'=>'Spakye', 'nom'=>'Magnac', 'prenom'=>'Léo', 'email'=>'leomagnac@gmail.com', 'password'=>'Yoloswag33', 'avatar'=>null, 'date_inscription'=>'2018-07-21', 'score'=>1000, 'facebook'=>null, 'soundcloud'=>'https://soundcloud.com/user-686215597', 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']]

        ];
        

        foreach($users as $user) { 
            $test= new Users();
            $test->setUsername($user['username']);
            $test->setNom($user['nom']);
            $test->setPrenom($user['prenom']);
            $test->setEmail($user['email']);
            $test->setPassword($user['password']);
            $test->setAvatar($user['avatar']);
            $test->setDateinscription(new \DateTime($user['date_inscription']));
            $test->setScore($user['score']);
            $test->setFacebook($user['facebook']);
            $test->setSoundcloud($user['soundcloud']);
            $test->setBandcamp($user['bandcamp']);
            $test->setSiteweb($user['site_web']);
            $test->setBio($user['bio']);
            $test->setRole($user['role']);
            $manager->persist($test);

            $this->addReference($user['username'], $test);

        }
        $manager->flush();

    

            $articles=[
           
            ['titre'=>'Fellez : L\’arbre et la pirogue', 'content'=>'Bordeaux. Janvier 2018. Le rappeur Fellez sort 4 titres. 15 minutes de musique. En compagnie d\’un arbre et d’une pirogue.
En temps normal, les projets courts restent tapis dans un coin, avant le dossier de presse d\’un premier album. L\’arbre et la pirogue a des qualités qui mérite déjà qu\’on s\’y intéresse. Fellez s\’est affiché au sein du collectif Errör 404, qui a sorti No Projet vol.1 fin 2015, auquel nous conseillons aux amateurs de jeter une oreille, enfin les deux. Tout commence ici par un crépitement. Celui du vinyle. Puis c\’est un clavier. La prod se déroule lentement sous les pas de « Madame Rêve ». Un titre sur les envies inachevées, les limites palpables. Un titre nostalgique, un brin chaloupé, avec de la route et une écriture qui vise juste. À vitesse de pirogue donc.L\’atmosphère change radicalement avec « Sale soir d\’été », où certains reconnaitront une prod signée Le Parasite. Le son est lourd, ça ressemble à des projets signés Le Sept (qui vient d\’ailleurs de sortir Amoco Cadiz mais le sujet n\’est pas là), ça parle des « familles de merde » et des interrogations douloureuses, des phases efficaces et des images fortes qui vont aussi chercher une poésie proche de la plume de Arm (« j\’reprends la route, le cœur déjà frappé par la foudre »). Une pesanteur reprise avec lenteur sur « Nouvel air » où l\’on perçoit au loin des sons issus de « Feeling good »; électro downtempo et phrasé rythmique, Fellez est maître à bord de son vaisseau.

Dans ses questions Fellez imagine demain sur un dernier titre; un sample avec piano et cordes que n\’aurait pas renié Barbara, pour conter l\’envie d\’un toit pour trois, niché dans un arbre à l\’abri du froid. Fellez trace ses échecs et ses désirs avec une plume convaincante et une voix prenante. 15 minutes dans une pirogue qui ne demande qu\’une chose : la suite du voyage. Source : Imprimerie Nocturne', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-24', 'image'=>'http://imprimerienocturne.com/wp-content/uploads/2016/02/fellez-disques-435x290.jpg'],
['titre'=>'Spécial Compositeur de Films', 'content'=>'Citons en vrac des noms tels que Ennio Morricone, Vangelis, Bruno Coulais et j/’en passe…Le cinéma et ses compositeurs sont des sources de samples pour les producteurs hiphop (mais pas que). On ne compte plus le nombre de bandes originales de films samplés, mais aussi des dialogues ou des extraits sonores.
Cinéma et hiphop font souvent bon ménage, et pour ma part je retiens des morceaux comme « Dernier domicile connu », et un de mes coups de coeur, le sample de la bande originale du Grand Blond par Gérard Baste et Pedro Winter.', 'auteur_id'=>$this->getReference('Spakye'), 'date_publi'=>'2018-07-23', 'image'=>'http://www.imagesyoulike.com/images/d/32x24/d3299.jpg']
            
        ];
        

        foreach($articles as $article) { 
            $test= new Articles();
            $test->setTitre($article['titre']);
            $test->setContent($article['content']);
            $test->setAuteurId($article['auteur_id']);
            $test->setDatePubli(new \DateTime($article['date_publi']));
            $test->setImage($article['image']);
            $manager->persist($test);

        }
        $manager->flush();
 

            

    }     
}
