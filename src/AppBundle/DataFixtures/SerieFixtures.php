<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 25/02/2018
 * Time: 10:06
 */

namespace AppBundle\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Serie;

class SerieFixtures extends Fixture
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        // Tableau qui contient les infos qui vont etre envoyées en bdd
        $series = [
            [
                "titre"=>"La Casa de Papel",
                "annee"=>"2017-11-05",
                "acteur"=>"Álvaro Morte, Pedro Alonso, Úrsula Corberó",
                "description"=>"Huit voleurs font une prise d'otages dans la Maison royale de la Monnaie d'Espagne, tandis 
                qu'un génie du crime manipule la police pour mettre son plan à exécution."
            ],
            [
                "titre"=>"Altered Carbon",
                "annee"=>"2018-01-10",
                "acteur"=>"Joel Kinnaman, James Purefoy, Martha Higareda",
                "description"=>"Takeshi Kovacs est un ancien soldat et seul survivant d’un groupe de guerriers d'élite vaincus 
                lors d’un soulèvement contre le nouvel ordre mondial. Son esprit est emprisonné \"dans la glace\" pendant des siècles, 
                jusqu’à ce que Laurens Bancroft, un homme extrêmement riche et vivant depuis plusieurs siècles lui offre la chance 
                de vivre à nouveau. En échange, Kovacs doit résoudre un meurtre... celui de Bancroft lui-même."
            ],
            [
                "titre"=>"Les Bracelets rouges",
                "annee"=>"2018-01-22",
                "acteur"=>"Audran Cattin, Tom Rivoire, Esther Valding",
                "description"=>"Malgré les maladies dont ils souffrent et qu’ils doivent combattre au quotidien, Thomas, 
                Clément, Roxane, Mehdi, Sarah et Côme, qui forment la bande des Bracelets rouges, sont bien décidés à vivre à 
                fond leur vie d’adolescent même si elle se déroule à l’hôpital. Entourés par des parents parfois impuissants, 
                et encadrés par un personnel soignant qui tente de garder la tête froide, ils vont vivre, entre premiers émois 
                amoureux, trahisons, rechutes et guérisons, des épreuves qui vont changer leur vie."
            ],
            [
                "titre"=>"Peaky Blinders",
                "annee"=>"2013-05-12",
                "acteur"=>"Cillian Murphy, Helen McCrory, Paul Anderson",
                "description"=>"En 1919, à Birmingham, soldats, révolutionnaires politiques et criminels combattent pour se faire une 
                place dans le paysage industriel de l'après-Guerre. Le Parlement s'attend à une violente révolte, et Winston Churchill 
                mobilise des forces spéciales pour contenir les menaces. La famille Shelby compte parmi les membres les plus redoutables. 
                Surnommés les \"Peaky Blinders\" par rapport à leur utilisation de lames de rasoir cachées dans leurs casquettes, ils 
                tirent principalement leur argent de paris et de vol. Tommy Shelby, le plus dangereux de tous, 
                va devoir faire face à l'arrivée de Campbell, un impitoyable chef de la police qui a pour mission de nettoyer 
                la ville. Ne doit-il pas se méfier tout autant la ravissante Grace Burgess ? Fraîchement installée dans le voisinage, 
                celle-ci semble cacher un mystérieux passé et un dangereux secret."
            ],
            [
                "titre"=>"The Walking Dead",
                "annee"=>"2010-08-15",
                "acteur"=>"Andrew Lincoln, Norman Reedus, Jeffrey Dean Morgan",
                "description"=>"Après une apocalypse ayant transformé la quasi-totalité de la population en zombies, un groupe 
                d'hommes et de femmes mené par l'officier Rick Grimes tente de survivre... Ensemble, ils vont devoir tant bien que mal 
                faire face à ce nouveau monde devenu méconnaissable, à travers leur périple dans le Sud profond des États-Unis."
            ],
            [
                "titre"=>"Black Mirror",
                "annee"=>"2011-05-18",
                "acteur"=>"Michaela Coel, Daniel Lapaine, Georgina Campbell",
                "description"=>"Chaque épisode de cette anthologie montre la dépendance des hommes vis-à-vis de tout ce qui a un écran..."
            ]
        ];

        // Ajout des infos de series ($series[]) dans la table "serie" de la base de données
        foreach ($series as $serie) {
            $serieInfo = new Serie();
            $serieInfo
                ->setTitre($serie["titre"])
                ->setAnnee(new \DateTime($serie["annee"]))
                ->setActeur($serie["acteur"])
                ->setDescription($serie["description"]);

            $manager->persist($serieInfo);
        }
        $manager->flush();
    }
}