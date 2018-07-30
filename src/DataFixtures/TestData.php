<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Entity\Tracks;
use App\Entity\Articles;
use App\Entity\Users;
use App\Entity\Relations;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TestData extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        //lors de l'instanciation de la classe, on va stocker l'encoder dans la propriété
        $this->encoder= $encoder;
    }
    public function load(ObjectManager $manager)
    {

        $users=[
            ['username'=>'Tooty', 'nom'=>'Lemarchand', 'prenom'=>'Julien', 'email'=>'jl.julienlemarchand@gmail.com', 'password'=>'Julien83', 'avatar'=>null, 'date_inscription'=>'2018-07-23', 'score'=>3, 'facebook'=>null, 'soundcloud'=>null, 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']],
            ['username'=>'Fellez', 'nom'=>'Marchand', 'prenom'=>'Benjamin', 'email'=>'bejimarch@gmail.com', 'password'=>'Error404', 'avatar'=>'fellez2.jpg', 'date_inscription'=>'2018-07-20', 'score'=>1, 'facebook'=>'https://www.facebook.com/FellezBdx/', 'soundcloud'=>'https://soundcloud.com/ben-march-1', 'bandcamp'=>'https://err404.bandcamp.com/album/larbre-et-la-pirogue', 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_USER']],
            ['username'=>'Aoced', 'nom'=>'Arnaudet', 'prenom'=>'Cédric', 'email'=>'aoced33@gmail.com', 'password'=>'Araratbx33', 'avatar'=>'aoced.jpeg', 'date_inscription'=>'2018-07-21', 'score'=>3, 'facebook'=>null, 'soundcloud'=>'https://soundcloud.com/robin-master', 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']],
            ['username'=>'dulcine', 'nom'=>'Cadic', 'prenom'=>'Dulce', 'email'=>'dulce.cesar263@gmail.com', 'password'=>'1985Arcachon', 'avatar'=>null, 'date_inscription'=>'2018-07-21', 'score'=>3, 'facebook'=>null, 'soundcloud'=>null, 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']],
            ['username'=>'Spakye', 'nom'=>'Magnac', 'prenom'=>'Léo', 'email'=>'leomagnac@gmail.com', 'password'=>'Yoloswag33', 'avatar'=>null, 'date_inscription'=>'2018-07-21', 'score'=>1000, 'facebook'=>null, 'soundcloud'=>'https://soundcloud.com/user-686215597', 'bandcamp'=>null, 'site_web'=>null, 'bio'=>null, 'role'=>['ROLE_ADMIN']]

        ];


        foreach($users as $user) {
            $test= new Users();
            $test->setUsername($user['username']);
            $test->setNom($user['nom']);
            $test->setPrenom($user['prenom']);
            $test->setEmail($user['email']);
            $mdpEncoded = $this->encoder->encodePassword($test, $user['password']);
            $test->setPassword($mdpEncoded);
            $test->setAvatar($user['avatar']);
            $test->setDateinscription(new \DateTime($user['date_inscription']));
            $test->setScore($user['score']);
            $test->setFacebook($user['facebook']);
            $test->setSoundcloud($user['soundcloud']);
            $test->setBandcamp($user['bandcamp']);
            $test->setSiteweb($user['site_web']);
            $test->setBio($user['bio']);
            $test->setRoles($user['role']);
            $manager->persist($test);

            $this->addReference($user['username'], $test);

        }
        $artistes=[
            ['nom'=>'2Pac', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Joe Cocker', 'user'=>null, 'genre'=>'Rock', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Dr. Dre', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'David McCallum', 'user'=>null, 'genre'=>'Soul', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'113', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Curtis Mayfield', 'user'=>null, 'genre'=>'Soul', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Justice', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'The Brothers Johnson', 'user'=>null, 'genre'=>'Soul', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'The Notorious B.I.G.', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Diana Ross', 'user'=>null, 'genre'=>'Soul', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Daft Punk', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Eddie Johns', 'user'=>null, 'genre'=>'Disco', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Scred Connexion', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Kentarō Haneda', 'user'=>null, 'genre'=>'Générique', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Passi', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Barry De Vorzon', 'user'=>null, 'genre'=>'Générique', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Black Eyed Peas', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Dick Dale', 'user'=>null, 'genre'=>'Rock', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'A Tribe Called Quest', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Lou Reed', 'user'=>null, 'genre'=>'Rock', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Fellez', 'user'=>$this->getReference('Fellez'), 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Cortex', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Aoced', 'user'=>$this->getReference('Aoced'), 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Depeche Mode', 'user'=>null, 'genre'=>'Pop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'KRS-One', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Blondie', 'user'=>null, 'genre'=>'Pop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Stardust', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Chaka Khan', 'user'=>null, 'genre'=>'Soul', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Modjo', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Chic', 'user'=>null, 'genre'=>'Soul', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Busy P', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Vladimir Cosma', 'user'=>null, 'genre'=>'Générique', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Vanilla Ice', 'user'=>null, 'genre'=>'Hip-Hop', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Queen', 'user'=>null, 'genre'=>'Rock', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'David Guetta', 'user'=>null, 'genre'=>'Electro', 'article'=>null,'isvalidated'=>1],
            ['nom'=>'Simple Minds', 'user'=>null, 'genre'=>'Rock', 'article'=>null,'isvalidated'=>1]
        ];



        foreach($artistes as $artiste) {
            $test= new Artistes();
            $test->setNom($artiste['nom']);
            $test->setUser($artiste['user']);
            $test->setGenre($artiste['genre']);
            $test->setArticle($artiste['article']);
            $test->setIsValidated($artiste['isvalidated']);
            $manager->persist($test);

            $this->addReference($artiste['nom'].'_artist', $test);
        }

        $albums=[
            ['idartiste'=>$this->getReference('2Pac_artist'), 'nom'=>'All Eyez on Me', 'annee'=>'1995', 'pochette' =>'alleyezonme.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Joe Cocker_artist'), 'nom'=>'Joe Cocker', 'annee'=>'1972', 'pochette' =>'joecocker.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Dr. Dre_artist'), 'nom'=>'Chronic 2001', 'annee'=>'1999', 'pochette' =>'chronic2001.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('David McCallum_artist'), 'nom'=>'Music: A Bit More of Me', 'annee'=>'1967', 'pochette' =>'musicabitmoreofme.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('113_artist'), 'nom'=>'Les Princes De La Ville', 'annee'=>'1999', 'pochette' =>'lesprincesdelaville.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Curtis Mayfield_artist'), 'nom'=>'Sweet Exorcist', 'annee'=>'1974', 'pochette' =>'sweetexorcist.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Justice_artist'), 'nom'=>'Cross', 'annee'=>'2007', 'pochette' =>'cross.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('The Brothers Johnson_artist'), 'nom'=>'Light Up the Night', 'annee'=>'1980', 'pochette' =>'lightupthenight.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('The Notorious B.I.G._artist'), 'nom'=>'Life After Death', 'annee'=>'1997', 'pochette' =>'lifeafterdeath.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Diana Ross_artist'), 'nom'=>'Diana', 'annee'=>'1980', 'pochette' =>'diana.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Daft Punk_artist'), 'nom'=>'Discovery', 'annee'=>'2000', 'pochette' =>'discovery.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Eddie Johns_artist'), 'nom'=>'More Spell on You', 'annee'=>'1979', 'pochette' =>'morespellonyou.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Scred Connexion_artist'), 'nom'=>'Scred Selexion 99/2000', 'annee'=>'2000', 'pochette' =>'scredconnexion.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Kentarō Haneda_artist'), 'nom'=>'Space Cobra', 'annee'=>'1982', 'pochette' =>'cobra.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Passi_artist'), 'nom'=>'Les Tentations', 'annee'=>'1998', 'pochette' =>'lestentations.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Barry De Vorzon_artist'), 'nom'=>'Nadia’s Theme', 'annee'=>'1973', 'pochette' =>'nadiastheme.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Black Eyed Peas_artist'), 'nom'=>'Monkey Business', 'annee'=>'2005', 'pochette' =>'monkeybusiness.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Dick Dale_artist'), 'nom'=>'Deltone', 'annee'=>'1962', 'pochette' =>'deltone.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('A Tribe Called Quest_artist'), 'nom'=>'People’s Instinctive Travels', 'annee'=>'1990', 'pochette' =>'peoplesinstincttravels.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Lou Reed_artist'), 'nom'=>'Transformer', 'annee'=>'1972', 'pochette' =>'transformer.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Fellez_artist'), 'nom'=>'L’arbre et la pirogue', 'annee'=>'2018', 'pochette' =>'larbreetlapirogue.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Cortex_artist'), 'nom'=>'Troupeau Bleu', 'annee'=>'1975', 'pochette' =>'troupeaubleu.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Aoced_artist'), 'nom'=>'Steve Mcqueen', 'annee'=>'2017', 'pochette' =>'stevemcqueen.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Depeche Mode_artist'), 'nom'=>'Violator', 'annee'=>'1989', 'pochette' =>'violator.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('KRS-One_artist'), 'nom'=>'I Got Next', 'annee'=>'1997', 'pochette' =>'igotnext.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Blondie_artist'), 'nom'=>'Autoamerican', 'annee'=>'1980', 'pochette' =>'autoamerican.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Stardust_artist'), 'nom'=>'Stardust Ep', 'annee'=>'1998', 'pochette' =>'musicsoundsbetterwithyou.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Chaka Khan_artist'), 'nom'=>'What Cha’Gonna Do for Me', 'annee'=>'1981', 'pochette' =>'whatchagonnadoforme.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Modjo_artist'), 'nom'=>'Modjo', 'annee'=>'2000', 'pochette' =>'modjo.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Chic_artist'), 'nom'=>'Soup for One', 'annee'=>'1982', 'pochette' =>'soupforone.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Busy P_artist'), 'nom'=>'Busy P Ep', 'annee'=>'2009', 'pochette' =>'busypbaste.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Vladimir Cosma_artist'), 'nom'=>'Le Grand Blond (BOF)', 'annee'=>'1972', 'pochette' =>'legrandblond.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Vanilla Ice_artist'), 'nom'=>'Hooked', 'annee'=>'1990', 'pochette' =>'hooked.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Queen_artist'), 'nom'=>'Hot Space', 'annee'=>'1981', 'pochette' =>'hotspace.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('David Guetta_artist'), 'nom'=>'Guetta Blaster', 'annee'=>'2004', 'pochette' =>'guettablaster.jpg','isvalidated'=>1],
            ['idartiste'=>$this->getReference('Simple Minds_artist'), 'nom'=>'New Gold Dream', 'annee'=>'1982', 'pochette' =>'newgolddream.jpg','isvalidated'=>1]


        ];

        foreach($albums as $album) {
            $test= new Albums();
            $test->setIdartiste($album['idartiste']);
            $test->setNom($album['nom']);
            $test->setAnnee($album['annee']);
            $test->setPochette($album['pochette']);
            $test->setIsValidated($album['isvalidated']);
            $manager->persist($test);

            $this->addReference($album['nom'].'_album', $test);
        }

        $tracks=[

            ['idalbum'=>$this->getReference('All Eyez on Me_album'),'isvalidated'=>1, 'titre'=>'California Love', 'lien'=>'5wBTdfAkqGU', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Joe Cocker_album'),'isvalidated'=>1, 'titre'=>'Woman to Woman', 'lien'=>'9UC3y5QYJ_4', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Chronic 2001_album'),'isvalidated'=>1, 'titre'=>'The Next Episode', 'lien'=>'QZXc39hT8t4', 'date_publi'=> '2018-07-22'],
            ['idalbum'=>$this->getReference('Music: A Bit More of Me_album'),'isvalidated'=>1, 'titre'=>'The Edge', 'lien'=>'6pG_3jZxzlo', 'date_publi'=> '2018-07-22'],
            ['idalbum'=>$this->getReference('Les Princes De La Ville_album'),'isvalidated'=>1, 'titre'=>'Les Princes De La Ville', 'lien'=>'EdyzIh0to1c', 'date_publi'=> '2018-07-21'],
            ['idalbum'=>$this->getReference('Sweet Exorcist_album'),'isvalidated'=>1, 'titre'=>'Make Me Believe in You', 'lien'=>'fexIgzfOAiE', 'date_publi'=> '2018-07-21'],
            ['idalbum'=>$this->getReference('Cross_album'),'isvalidated'=>1, 'titre'=>'Newjack', 'lien'=>'9f-NQZYCZnA', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Light Up the Night_album'),'isvalidated'=>1, 'titre'=>'You Make Me Wanna Wiggle', 'lien'=>'LDzH7ecKt7U', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Life After Death_album'),'isvalidated'=>1, 'titre'=>'Mo Money Mo Problems', 'lien'=>'gUhRKVIjJtw', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Diana_album'),'isvalidated'=>1, 'titre'=>'I’m Coming Out', 'lien'=>'zbYcte4ZEgQ', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Discovery_album'),'isvalidated'=>1, 'titre'=>'One More Time', 'lien'=>'FGBhQbmPwH8', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('More Spell on You_album'),'isvalidated'=>1, 'titre'=>'More Spell on You', 'lien'=>'53p7ogqJqqs', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Scred Selexion 99/2000_album'),'isvalidated'=>1, 'titre'=>'Scred Connexion Feat Fabe', 'lien'=>'uM9ZM1Jgs7k', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Space Cobra_album'),'isvalidated'=>1, 'titre'=>'Shi No Kōshin', 'lien'=>'37FCzjAvdE0', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Les Tentations_album'),'isvalidated'=>1, 'titre'=>'Je Zappe Et Je Mate', 'lien'=>'HRLmmnzbQHE', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Nadia’s Theme_album'),'isvalidated'=>1, 'titre'=>'Nadia’s Theme', 'lien'=>'Vlv32UEazGc', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Monkey Business_album'),'isvalidated'=>1, 'titre'=>'Pump It', 'lien'=>'ZaI2IlHwmgQ', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Deltone_album'),'isvalidated'=>1, 'titre'=>'Miserlou', 'lien'=>'qJmI6fAPUSk', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('People’s Instinctive Travels_album'),'isvalidated'=>1, 'titre'=>'Can I Kick It?', 'lien'=>'7D_JwgIM-y4', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Transformer_album'),'isvalidated'=>1, 'titre'=>'Walk on the Wild Side', 'lien'=>'oG6fayQBm9w', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('L’arbre et la pirogue_album'),'isvalidated'=>1, 'titre'=>'Madame Rêve', 'lien'=>'VW6xBr3aMcQ', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Troupeau Bleu_album'),'isvalidated'=>1, 'titre'=>'Go Round', 'lien'=>'GutIaarek20', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Steve Mcqueen_album'),'isvalidated'=>1, 'titre'=>'The Hunter', 'lien'=>'plHm06Xs0Vk', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('Violator_album'),'isvalidated'=>1, 'titre'=>'Personal Jesus', 'lien'=>'u1xrNaTO1bI', 'date_publi'=> '2018-07-23'],
            ['idalbum'=>$this->getReference('I Got Next_album'),'isvalidated'=>1, 'titre'=>'Step Into a World', 'lien'=>'xbJxcFyaCpI', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Autoamerican_album'),'isvalidated'=>1, 'titre'=>'Rapture', 'lien'=>'pHCdS7O248g', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Stardust Ep_album'),'isvalidated'=>1, 'titre'=>'Music Sounds Better With You', 'lien'=>'BEq9PUE0AE0', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('What Cha’Gonna Do for Me_album'),'isvalidated'=>1, 'titre'=>'Fate', 'lien'=>'eFQdCRQd3yg', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Modjo_album'),'isvalidated'=>1, 'titre'=>'Lady', 'lien'=>'/mMfxI3r_LyA', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Soup for One_album'),'isvalidated'=>1, 'titre'=>'Soup for One', 'lien'=>'PZj-5DZn-fs', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Busy P Ep_album'),'isvalidated'=>1, 'titre'=>'Le Grand Blond (remix)', 'lien'=>'Zo0R-uygeJU', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Le Grand Blond (BOF)_album'),'isvalidated'=>1, 'titre'=>'Sirba', 'lien'=>'Itkn6xC4lTY', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Hooked_album'),'isvalidated'=>1, 'titre'=>'Ice Ice Baby', 'lien'=>'rog8ou-ZepE', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Hot Space_album'),'isvalidated'=>1, 'titre'=>'Under Pressure', 'lien'=>'UWkIY7-FFTY', 'date_publi'=> '2018-07-27'],
            ['idalbum'=>$this->getReference('Guetta Blaster_album'),'isvalidated'=>1, 'titre'=>'The World Is Mine', 'lien'=>'13EsiCjsssY', 'date_publi'=> '2018-07-20'],
            ['idalbum'=>$this->getReference('New Gold Dream_album'),'isvalidated'=>1, 'titre'=>'Someone Somewhere', 'lien'=>'UW_VlaWDEYM', 'date_publi'=> '2018-07-20']
        ];


        foreach($tracks as $track) {
            $test= new Tracks();
            $test->setIdalbum($track['idalbum']);
            $test->setTitre($track['titre']);
            $test->setIsValidated($track['isvalidated']);
            $test->setLien($track['lien']);
            $test->setDatePubli(new \DateTime($track['date_publi']));

            $manager->persist($test);

            $this->addReference($track['titre'].'_track', $test);
        }





        $relations=[
            ['sampleur'=>$this->getReference('California Love_track'), 'original'=>$this->getReference('Woman to Woman_track'),'isvalidated'=>1,'user'=>$this->getReference('Spakye')],
            ['sampleur'=>$this->getReference('The Next Episode_track'), 'original'=>$this->getReference('The Edge_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Les Princes De La Ville_track'), 'original'=>$this->getReference('Make Me Believe in You_track'),'isvalidated'=>1,'user'=>$this->getReference('Tooty')],
            ['sampleur'=>$this->getReference('Newjack_track'), 'original'=>$this->getReference('You Make Me Wanna Wiggle_track'),'isvalidated'=>1,'user'=>$this->getReference('Spakye')],
            ['sampleur'=>$this->getReference('Mo Money Mo Problems_track'), 'original'=>$this->getReference('I’m Coming Out_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('One More Time_track'), 'original'=>$this->getReference('More Spell on You_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Scred Connexion Feat Fabe_track'), 'original'=>$this->getReference('Shi No Kōshin_track'),'isvalidated'=>1,'user'=>$this->getReference('Spakye')],
            ['sampleur'=>$this->getReference('Je Zappe Et Je Mate_track'), 'original'=>$this->getReference('Nadia’s Theme_track'),'isvalidated'=>1,'user'=>$this->getReference('Tooty')],
            ['sampleur'=>$this->getReference('Pump It_track'), 'original'=>$this->getReference('Miserlou_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Can I Kick It?_track'), 'original'=>$this->getReference('Walk on the Wild Side_track'),'isvalidated'=>1,'user'=>$this->getReference('dulcine')],
            ['sampleur'=>$this->getReference('Madame Rêve_track'), 'original'=>$this->getReference('Go Round_track'),'isvalidated'=>1,'user'=>$this->getReference('Fellez')],
            ['sampleur'=>$this->getReference('The Hunter_track'), 'original'=>$this->getReference('Personal Jesus_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Step Into a World_track'), 'original'=>$this->getReference('Rapture_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Music Sounds Better With You_track'), 'original'=>$this->getReference('Fate_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Lady_track'), 'original'=>$this->getReference('Soup for One_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Le Grand Blond (remix)_track'), 'original'=>$this->getReference('Sirba_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('Ice Ice Baby_track'), 'original'=>$this->getReference('Under Pressure_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')],
            ['sampleur'=>$this->getReference('The World Is Mine_track'), 'original'=>$this->getReference('Someone Somewhere_track'),'isvalidated'=>1,'user'=>$this->getReference('Aoced')]

        ];



        foreach($relations as $relation) {
            $test= new Relations();
            $test->setSampleur($relation['sampleur']);
            $test->setOriginal($relation['original']);
            $test->setIsValidated($relation['isvalidated']);
            $test->setIsValidated($relation['isvalidated']);
            $test->setUser($relation['user']);
            $manager->persist($test);


        }







        $articles=[

            ['titre'=>'Fellez : L’arbre et la pirogue', 'image'=>'fellezart.jpeg', 'content'=>'Bordeaux. Janvier 2018. Le rappeur Fellez sort 4 titres. 15 minutes de musique. En compagnie d’un arbre et d’une pirogue.En temps normal, les projets courts restent tapis dans un coin, avant le dossier de presse d’un premier album. L’arbre et la pirogue a des qualités qui mérite déjà qu’on s’y intéresse. Fellez s’est affiché au sein du collectif Errör 404, qui a sorti No Projet vol.1 fin 2015, auquel nous conseillons aux amateurs de jeter une oreille, enfin les deux. Tout commence ici par un crépitement. Celui du vinyle. Puis c’est un clavier. La prod se déroule lentement sous les pas de « Madame Rêve ». Un titre sur les envies inachevées, les limites palpables. Un titre nostalgique, un brin chaloupé, avec de la route et une écriture qui vise juste. À vitesse de pirogue donc.L’atmosphère change radicalement avec « Sale soir d’été », où certains reconnaitront une prod signée Le Parasite. Le son est lourd, ça ressemble à des projets signés Le Sept (qui vient d’ailleurs de sortir Amoco Cadiz mais le sujet n’est pas là), ça parle des « familles de merde » et des interrogations douloureuses, des phases efficaces et des images fortes qui vont aussi chercher une poésie proche de la plume de Arm (« j’reprends la route, le cœur déjà frappé par la foudre »). Une pesanteur reprise avec lenteur sur « Nouvel air » où l’on perçoit au loin des sons issus de « Feeling good »; électro downtempo et phrasé rythmique, Fellez est maître à bord de son vaisseau.Dans ses questions Fellez imagine demain sur un dernier titre; un sample avec piano et cordes que n’aurait pas renié Barbara, pour conter l’envie d’un toit pour trois, niché dans un arbre à l’abri du froid. Fellez trace ses échecs et ses désirs avec une plume convaincante et une voix prenante. 15 minutes dans une pirogue qui ne demande qu’une chose : la suite du voyage. Source : Imprimerie Nocturne', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-24', 'video'=>null],

            ['titre'=>'Spécial Compositeur de Films', 'image'=>'film.jpg', 'content'=>'Citons en vrac des noms tels que Ennio Morricone, Vangelis, Bruno Coulais et j’en passe…Le cinéma et ses compositeurs sont des sources de samples pour les producteurs hiphop (mais pas que). On ne compte plus le nombre de bandes originales de films samplés, mais aussi des dialogues ou des extraits sonores.Cinéma et hiphop font souvent bon ménage, et pour ma part je retiens des morceaux comme « Dernier domicile connu », et un de mes coups de coeur, le sample de la bande originale du Grand Blond par Gérard Baste et Pedro Winter.', 'auteur_id'=>$this->getReference('Spakye'), 'date_publi'=>'2018-07-23', 'video'=>null],

            ['titre'=>'Le Jour ou Daft Punk a créé "One More Time"', 'image'=>'daft.jpg', 'content'=>'« One More Time » passe sur le bloc opératoire. Les samples issus de « More Spell On You » d’Eddie Johns sont découpés au millimètre, et on découvre avec toujours autant de plaisir l’origine du titre de Daft Punk.Sans aucune hésitation, la meilleure explication de ce sample ! A la fois claire et limpide, tout est reproduit à l’identique… Alors si vous deviez expliquer à des amis l’origine du sample de « One More Time », voilà la meilleure vidéo possible à partager !', 'auteur_id'=>$this->getReference('Tooty'), 'date_publi'=>'2018-07-21', 'video'=>'qrW7ugpEaLc'],

            ['titre'=>'Samples : Aux origines du Son Hip-Hop', 'image'=>'originehh.jpg', 'content'=>'C’est le genre d’initiative qui fait plaisir ! Un livre en français qui parle de samples, on ne pouvait pas passer à côté. Sorti prévue le 18 janvier 2018, « SAMPLE ! Aux origines du son hiphop » est édité par Le mot et le reste. L’ouvrage se veut accessible à tous, et permet d’avoir une compréhension générale de l’importance du sample dans la musique et la culture hiphop.L’intérêt numéro un du livre – à mon sens – réside dans les très nombreuses anecdotes. Passé l’histoire du sample et les pionniers du sampling, riche en informations, Brice Miclet s’est plongé dans des dizaines de titres afin d’analyser leur origine et le ou les samples qu’ils utilisent. Un véritable travail de fourmi qui passe en revue les histoires de samples qui ont fait la création des morceaux phares du hip-hop, mais aussi ceux un peu plus obscurs.Cette culture du sample fête ses 40 ans : passée d’une méthode de création obscure et décriée, le sampling s’est élevé au rang d’art. Même si certains producteurs vont jouer la facilité avec le sample, on ne peut que saluer le travail incroyable que certains arrivent à produire avec des extraits de vieux morceaux. Un ouvrage qui nous (re)plonge dans cette culture du collage qui puise ses origines dans le funk, le jazz, le rock, le disco, le classique et même la chanson française. Un ouvrage qui salue aussi l’évolution technologique des outils qui permettent de sampler.Bref, si vous êtes curieux de connaître l’origine des morceaux hiphop à base de samples, en savoir plus sur une culture qui célèbre ses 40 ans, et friand d’anecdotes sur les classiques (mais pas que) du hiphop, ce livre est fait pour vous !', 'auteur_id'=>$this->getReference('dulcine'), 'date_publi'=>'2018-07-20', 'video'=>null],

            ['titre'=>'Quand 2Pac sample Joe Cocker', 'image'=>'2pacart.jpg', 'content'=>'Joe Cocker a laissé une empreinte loin d’être négligeable dans le sillon de la culture Hip-Hop. Petit retour en 1972 : à l’époque, Joe Cocker et Chris Stainton, avec Nigel Thomas à la production, bossent sur de nouveaux titres. "Woman To Woman" en fait partie, et sera un extrait de l’album Joe Cocker. La chanson va vite devenir un classique Au point que l’on recense près de 22 occurrences de "Woman to Woman", entre Prefuse 73, PMD, The Hight & Mighty, Frank T, Strugglin Souls, Queen Mother Rage ou encore King Giddra..Mais la chanson ultime, celle qui a fait connaître ce sample au grand public, n’est autre qu’un énorme tube qui convie deux géants du hip-hop américain. On est en 1995. À ma gauche, 2pac, 25 ans, qui vient tout juste de sortir de prison. À ma droite, Dr. Dre, producteur, qui apparaît également en featuring.Joe Cocker est donc à l’origine de "California Love", le hit qui a permis de faire entrer 2Pac dans le mainstream : Elu 41ème meilleure chanson de tous les temps par le magazine Rolling Stone, ce morceau n’a ironiquement jamais figuré sur un album studio du rappeur californien. Sa version originale n’est disponible que sur la compilation Greatest Hits - l’album All Eyez on Me (1996) n’en offrant qu’une version remixée.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Où Dr. Dre a-t-il a t’il puisé son sample pour "Next Episode"?', 'image'=>'drestudio.jpg', 'content'=>'Vous êtes-vous déjà demandé d’où provenait le sample du titre "Next Episode" ? Tout le monde a entendu ce titre dans Chronic 2001 , même si vous n’êtes pas un fan de musique Hip-Hop. "Next Episode" était l’une des chansons les plus emblématiques de sa décennie. Vous serez surpris de voir combien d’autres artistes ont tiré le même échantillon de l’original, ou même de la propre chanson de Dr Dre. L’original est une composition de David McCallum intitulée "The Edge". "The Edge" a été initialement publié en 1976, mais David agit encore aujourd’hui. Il joue le médecin légiste dans la série NCIS. Avant que Dr. Dre ait sorti sa version de l’échantillon, un autre artiste avait déjà utilisé cette boucle. "MIA" a publié "Missin Linx" en 1998, presque un an avant que le Dr Dre ait sorti sa version.Dr. Dre a-t-il pris le rythme de ce modeste trio de rap ? Qui sait vraiment quelle chanson a inspiré "Next Episode" mais ce riff emblématique a continué à attirer un nombre inconsidéré d’artistes.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Curtis le Prince de la Ville', 'image'=>'curtisart.jpg', 'content'=>'Le vrai mérite du Rap, c’est d’avoir ressuscité et même dépoussiéré les grands classiques de la soul. Sur l’album Les Princes de la ville en 1999, grâce au producteur régrété DJ Mehdi qui sample des cordes de "Make Me Believe In You" de Curtis Mayfield (1974) sur l’intemporel "Les Princes de la ville". Ce titre a quelque chose d’effréné, de très surprenant au vu du son rap de l’époque. Un décalage sonore qui fait qu’aujourd’hui encore ce morceau continue de hanter les setlists des soirées hip-hop et des sets électroniques sans distinction. Dans un premier temps, tout réside dans le tempo, bien plus rapide que celui d’une chanson rap lambda du moment. Ensuite, ce sont les filtres qui créent l’ambiance. Au tout début du morceau, par exemple, on entend les cordes se découvrir progressivement, d’abord très assourdies, puis de plus en plus claires. Manier les filtres est un art dans la production hip-hop. Aux États-Unis, le producteur Pete Rock en avait fait sa spécialité. Au milieu du morceau, DJ Mehdi les réutilise pour créer une respiration, faisant presque disparaître les cordes piquées chez Curtis Mayfield pour les faire revenir de plus belle.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Justice pour les Brothers Johnson', 'image'=>'justiceart.JPG', 'content'=>'Sur le premier album de Justice, on retrouve le morceau « Newjack » et son sample soul emprunté aux Brothers Johnson. Que dire sur les Brothers Johnson si ce n’est qu’il s’agit d’un groupe indispensable à tout amateur de funk ! Pour info George et Louis Johnson ont accompagné les plus grands tels que Bobby Womack ou bien encore les Supremes. Avant leur séparation en 1982, Louis a été le bassiste de Michael Jackson sur l’album Thriller et George collabora avec Quincy Jones …', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Mo Money Mo Dianna', 'image'=>'notouriousart.jpg', 'content'=>'" Mo Money Mo Problems " est un single de The Notorious BIG , le deuxième single de son album Life After Death . Sorti à titre posthume, le single a battu touts les records de vente pendant deux semaines en 1997, remplaçant « I’ll Be Missing You », hommage produit et réalisé par Puff Daddy à la mort du rappeur lui-même. La chanson est le deuxième single posthume de Notorious BIG, après " Hypnotize ", faisant de lui le seul artiste de l’histoire à avoir deux singles N°1 à titre posthume. La chanson a été nominée pour les Grammy Award 1998 dans la catégorie meilleure performance rap.La chanson propose des chants de Mase et Sean Puff Daddy Combs. L’instrument contient un échantillon de la chanson de Diana Ross " I’m Coming Out ", y compris des choeurs qui répètent le titre de cette chanson. Le refrain de la chanson a été chanté par Kelly Price .', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Des samples incongrus dans le rap français', 'image'=>'cobraart.jpg', 'content'=>'Le rap français fait parfois preuve de fulgurance quand il s’agit de dénicher des échantillonnages musicaux incongrus ou tout simplement des samples de malade. Parmi les choix artistiques parfois douteux, on retrouve des grands classiques du cinéma, des longs métrages et même des séries télévisées qui ont bercé notre enfance. Et on ne va pas se mentir, ça aboutit parfois à de très bons morceaux. Aujourd’hui portés disparus, Fabe et la Scred Connexion ont laissé une trace indéniable dans le rap français. Et comme beaucoup de jeune de leurs générations, ils aimaient les mangas. Et donc Cobra, pour lequel ils ont repris le générique de fin de la série animée Cobra, intitulé « Shi no koshin ». Dernièrement cette même boucle a été reprise pour l’émission le Gros Journal de Canal+, de Mouloud Achour.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Les Feux de l’amour pour Passi', 'image'=>'passiart.jpg', 'content'=>'À l’origine intitulée Cotton’s Dream, elle apparaissait dans la bande son du film Bless the Beasts and Children, sorti en 1971.Elle fut rebaptisée Nadia’s Theme, à la suite de son utilisation lors d’une compilation des performances de l’immense gymnaste roumaine Nadia Comăneci lors des Jeux olympiques de 1976. La chanteuse Mary J. Blige a également repris cette musique en 2001 pour l’un de ses succès No More Drama.Cette musique est est composée d’enchainements de violon et de piano.La musique est la même depuis le début du feuilleton, soit depuis le 26 mars 1973.Entre décembre 1999 et mars 2003, une variante de saxophone et de piano a été utilisée, elle a depuis été abandonnée.Les génériques de début et de fin d’épisode sont légèrement différents aujourd’hui. C’est en 1998 que Passi reprend cette boucle pour le titre Je Zappe Et Je Mate dans son premier album solo intitulé les tentations ', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Will.i.am inspire par Tarentino', 'image'=>'blackeyedpeasart.jpg', 'content'=>'Pump It est une chanson du groupe américain The Black Eyed Peas extraite de l’album Monkey Business. Le titre est sorti en tant que quatrième et dernier single de l’album le 17 janvier 2006. Pump It est fortement inspirée du titre Misirloude Dick Dale (1962), qi elle même est une adaptation d’une chanson populaire grecque. Difficile donc de situer l’origine exacte de cet air … Cependant plusieurs sources affirment qu’ il s’agit d’une chanson du genre musical de Rebetiko à ses débuts, chantée pour la première fois en 1927 par l’orchestre de Michalis Patrinos.C’est à partir de 1930 que la chanson connaît de nouvelles interprétations, suite à son arrivée sur le continent américain.Au début des années 60, Dick Dale arrange la chanson en un solo de guitare, suite à la demande d’un fan qui voulait voir Dick Dale jouer un morceau entier sur une seule corde. Quentin Tarantino lui a donné une seconde jeunesse au début des années 90, en incluant de titre dans la BO du film Pulp Fiction.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Lou Reed empoche le jackpote avec Tribe Called Quest', 'image'=>'tribeart.jpg', 'content'=>'Saviez-vous que le titre « Can I kick it? » utilise illégalement une boucle de « Walk on the wild side » de Lou Reed ?Dans une entrevue accordée à Rolling Stones, Phife Dawg déclarait que Lou Reed prenait 100% des royalties sur « Can I Kick it? ».« Je me souviens que Jive (le label) avait un problème avec les droits du sample.  Au lieu que Lou Reed dise « vous pouvez l’utiliser », il a dit « vous pouvez l’utiliser, mais je prends tout l’argent dessus ». A ce jour, on a pas eu un centime pour ce morceau. »A noter que Phife Dawg s’est montré très philosophe sur cette histoire de sample, disant qu’au moins le morceau a pu exister, malgré le fait que A Tribe Called Quest n’ait jamais rien gagné avec.Lou Reed et le hiphop ne s’arrête pas aux samples, puisque ce dernier avoue, dans les années 1990, être fan du genre. Il a même convié à la fin des années 80 Run DMC à une émission de télévision à laquelle il participait.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Jésus personnel', 'image'=>'depechemodeart.jpg', 'content'=>'" Personal Jesus " est une chanson du groupe anglais Depeche Mode , sortie le 28 août 1989 en tant que single de leur septième album, Violator (1990). Il a atteint le numéro 13 sur le Singles Chart britannique et le numéro 28 sur le Billboard Hot 100. Le single a été le premier à faire partie du Top 40 américain depuis " People Are People " en 1984 et a été son premier single certifié aux Etats-Unis (suivi rapidement de son successeur " Enjoy the Silence "). "Personal Jesus" a été réédité en single le 30 mai 2011 pour l’album de remix Depeche Mode Remixes 2: 81-11 , avec le remix leader de l’équipe de production Stargate .La chanson a été couverte par de nombreux artistes, y compris Johnny Cash , Marilyn Manson et Sammy Hagar . "Je n’ai jamais été un grand fan de la musique synthé dans les années quatre-vingt", a remarqué Hagar, "mais cette chanson a un groove badass et une lyrique cool."', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Rapture, le premier titre rap d’une Femme blanche ?', 'image'=>'blondieart.jpg', 'content'=>'KRS-One a utilisé l’ a cappella de Blondie sur son single "Step Into A World" en 1997.La chanson peut être entendue dans le film de 2013 This Is the End , où elle correspond au thème du ravissement. Nombreux sont ceux qui s’interroge de la place du titre de Blondie dans l’histoire du rap. Était-ce ... la première chanson de rap ? La première chanson de rap commerciale ? La première chanson de rap par une femme ?La réponse à tout ce qui précède est "pas vraiment", mais cela dépend de vos définitions. Et tandis que Rapper’s Delight était un succès, "Rapture" était la première chanson n ° 1 nationale. Fab 5 Freddy l’exprime ainsi:Pour une grande partie du grand public blanc, c’était la première fois qu’ils entendaient du rap, et cela ouvrait la voie...', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'L’hymne de la French Touch', 'image'=>'stardustart.jpg', 'content'=>'C’était en 1998 que Stardust s’est rapidement imposé comme un classique house. Et pour cause, sous ce pseudonyme se cache trois grands noms : Alan Braxe, Thomas Bangalter (la moitié de Daft Punk) et Benjamin Diamond.On l’oublie, mais Music sounds better with you est le fruit d’un pur hasard : en 1995, Thomas Bangalter, l’homme avec toujours un coup d’avance, crée son propre label, Roulé, où il publie au compte gouttes des maxis de House, et sample même pour rigoler Claude François. Trois ans plus tard, début 1998, Alan Braxe vient d’y publier un titre nommé Vertigo.Des répétitions s’organisent au Rex Club avec Bangalter (aux claviers et à la basse) et Benjamin Diamond (au chant). C’est là, au détour d’un jam, que nait ce morceau après que le trio est tombé ser cette fameuse boucle.Quand on connait le passif des Daft Punk en matière de sample, on ne sera pas étonné de trouver le sample de Stardust dans la collection des disque soul de papa. En effet, la boucle tout le long du morceau est en réalité un titre de Chaka Khan, la chanteuse d’R’nB des années 80. Fate figure sur l’album What cha’ gonna do for me, sortie en 1981. Chaka Khan est une artiste soul originaire de Chicago et connue principalement pour ses tubes « Ain’t Nobody » et « I’m Every Woman ». Récompensée de 8 Grammys elle a exploré plusieurs genre musicaux au cours de sa longue carrière, allant de la Soul au Disco, en passant par le Rock et même le Hiphop.Ce titre qui est devenu l’hymne du mouvement French Touch…La chanson est reprise plus tard par les Daft Punk lors de la tournée Alive 2006/2007, avec des éléments des titres One More Time, Aerodynamic, The Prime Time of Your Life (remixée par Para One), Human After All, Revolution 909 et Together, chanson du projet éponyme auquel participe Thomas Bangalter (avec DJ Falcon). Concluant les concerts, la piste apparaît en tant que bonus sur Alive 2007. Music Sounds Better with You apparaît également dans le jeu vidéo Grand Theft Auto V sur la radio Non Stop Pop FM.En juin 2018, Alan Braxe et Benjamin Diamond annoncent la sortie d’une version remasterisée pour célébrer les 20 ans de la sortie du titre original.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Soup for Lady', 'image'=>'modjoladyart.jpg', 'content'=>'Certainement un des samples les plus connus tous styles confondus, Modjo (alias Romain Tranchart & Yann Destal) et son « Lady » (2000) a véritablement transformé une boucle disco/funk en hit mondial ! Ces quelques notes samplées proviennent du morceau « Soup for one » (1982) d’un groupe incontournable : Chic. Quelques mots sur Chic, un des rares groupes disco/funk connus du plus grand nombre, qui est donc à l’origine de ce « Soup for one », créé pour le film du même nom. Groupe majeur de l’industrie du disque, véritable machine à tubes, emmenée par deux grands musiciens que sont Nile Rodgers (guitare) et Bernard Edwards (basse), Chic a inspiré des dizaines et des dizaines d’artistes.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'The Headbangers', 'image'=>'busypart.jpg', 'content'=>'Sorti en 2005, « The Headbangers » utilise un sample assez improbable emprunté à l’un des films les plus cultes du cinéma français.Gérard Baste   sortait il y a plus de 10 ans ce morceau passé assez inaperçu, basé sur l’instru du film  » Le Grand Blond avec une Chaussure Noire » sorti en 1972 et réalisé par Yves Robert. Il a fallu attendre que le génie de Pedro Winter remix le thème du film composé par Vladimir Cosma pour que cette track voit enfin le jour.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'Queen Vs Vanilla Ice', 'image'=>'vanillaiceart.jpg', 'content'=>'Pour toute personne ayant des tympans fonctionnels, il est clair que le hit du crossover Pop-rap de Vanilla Ice a samplé la ligne de basse de la collaboration Queen / Bowie (1981), intitulé "Under Pressure". Mais Vanilla Ice a  toujours insisté sur le fait que les deux mélodies sont distinctes parce qu’il a ajouté un beat entre les notes. Vanilla Ice a prétendu plus tard que cette raison n’était qu’une blague. Les représentants de Queen et Bowie ne riaient pas et menaçaient une poursuite pour atteinte aux droits d’auteur. L’affaire a été réglée à l’amiable, ce qui a coûté à Vanilla Ice une somme dont on ignore toujours le montant. Bowie et les membres de Queen ont tous reçu les crédits de droit d’auteur sur la piste. «Ice Ice Baby» a suscité des discussions sur les mesures punitives prises dans les cas de plagiat .Bien que les lois sur le droit d’auteur protègent bien les intérêts financiers des artistes, il y a moins de mesures en place pour protéger leurs intérêts créateurs. Dans ce cas, Vanilla Ice utilisait volontairement un crochet classique sans permission. Bien qu’il ait payé le prix, certains soutiennent que cela ne suffit pas à compenser la crédibilité potentielle perdue par Queen et David Bowie, qui sont maintenant liés à lui grâce à une collaboration qu’ils n’avaient pas le choix de rejoindre. Ice Ice Baby fut le premier morceau de hip-hop à conquérir la première place des charts (si on ne compte pas auparavant le Rapture de Blondie et le West End Girls des Pet Shop Boys).', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null],

            ['titre'=>'The Simple Minds’s world', 'image'=>'guettaart.jpg', 'content'=>'Elu meilleur DJ international en 2007 par le site djawards.com et nominé pour le « Best world DJ » aux World music awards, David Guetta est toujours sur le devant de la scène. Qu’on aime ou pas, il faut quand même reconnaître qu’il reste un ambassadeur et une des stars du milieu de la musique électronique. L’occasion de revenir sur un des samples les plus connus, celui de « The world is mine » (2005) emprunté à « Someone, somewhere in summertime » (1982) de Simple Minds.Guetta dépoussière un titre du groupe anglais Simple Mind en jouant avec un sample de Someone somewhere in summertime où la voix de JD Davis qui rappellent remarquablement celle de Dave Gahan, mérite d’être mentionnées sur The world is mine. Quand le choeur chante dans "The World Is Mine", l’illusion est presque parfaite. Ce mélange lui donne une saveur années 80 qui lui a valu un grand succès lors de sa sortie.', 'auteur_id'=>$this->getReference('Aoced'), 'date_publi'=>'2018-07-27', 'video'=>null]

        ];


        foreach($articles as $article) {
            $test= new Articles();
            $test->setTitre($article['titre']);
            $test->setContent($article['content']);
            $test->setAuteurId($article['auteur_id']);
            $test->setVideo($article['video']);
            $test->setDatePubli(new \DateTime($article['date_publi']));
            $test->setImage($article['image']);
            $manager->persist($test);

        }
        $manager->flush();




    }
}

