<?php
/**
 * Created by PhpStorm.
 * User: amandine
 * Date: 23/02/2018
 * Time: 14:26
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Film;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // TODO: Implement load() method.
        $films=[
            [
                "titre"=>"Thor : Ragnarok",
                "annee"=>"2017-11-23",
                "acteur"=>"Chris Hemsworth",
                "description"=>"Privé de son puissant marteau, Thor est retenu prisonnier sur une lointaine planète aux confins de l'univers.
                Pour sauver Asgard, il va devoir lutter contre le temps afin d'empêcher l'impitoyable Hela d'accomplir le Ragnarök 
                – la destruction de son monde et la fin de la civilisation asgardienne. Mais pour y parvenir, il va d'abord devoir mener
                 un combat titanesque de gladiateurs contre celui qui était autrefois son allié au sein des Avengers : l'incroyable Hulk…",
                "image"=>"a87402e0d76f6294e368dea8fbc70e61.jpeg",
                "video"=>"92e0eb5f125aa2b59a788674b8ca461c.mp4"
            ],
            [
                "titre"=>"Interview",
                "annee"=>"2015-05-12",
                "acteur"=>"James Franco, Seth Rogen, Lizzy Caplan",
                "description"=>"Un animateur de talk show et son producteur se retrouvent impliqués dans un complot meurtrier à l'échelle internationale.",
                "image"=>"ab333b9abc8635cad838e5705bb28e66.png",
                "video"=>"92e0eb5f125aa2b59a788674b8ca461c.mp4"
            ],
            [
                "titre"=>"Conjuring",
                "annee"=>"2013-10-30",
                "acteur"=>"Vera Farmiga, Patrick Wilson, Ron Livingston",
                "description"=>"Avant Amityville, il y avait Harrisville… Conjuring : Les dossiers Warren, raconte l'histoire horrible, mais vraie,
                 d'Ed et Lorraine Warren, enquêteurs paranormaux réputés dans le monde entier, venus en aide à une famille terrorisée par une présence
                 inquiétante dans leur ferme isolée… Contraints d'affronter une créature démoniaque d'une force redoutable, les Warren se retrouvent 
                 face à l'affaire la plus terrifiante de leur carrière…",
                "image"=>"1d9484fba9aafbe0fbf2d98be7f6c41a.png",
                "video"=>"92e0eb5f125aa2b59a788674b8ca461c.mp4"
            ],
            [
                "titre"=>"La ligne Verte",
                "annee"=>"2000-12-18",
                "acteur"=>"Tom Hanks, Michael Clarke Duncan, David Morse",
                "description"=>"Paul Edgecomb, pensionnaire centenaire d'une maison de retraite, est hanté par ses souvenirs. Gardien-chef du 
                pénitencier de Cold Mountain en 1935, il était chargé de veiller au bon déroulement des exécutions capitales en s'efforçant 
                d'adoucir les derniers moments des condamnés. Parmi eux se trouvait un colosse du nom de John Coffey, accusé du viol et du 
                meurtre de deux fillettes. Intrigué par cet homme candide et timide aux dons magiques, Edgecomb va tisser avec lui des liens très forts.",
                "image"=>"e8b120c06bf2e91fbc37e5cb14461abc.png",
                "video"=>"92e0eb5f125aa2b59a788674b8ca461c.mp4"
            ],
            [
                "titre"=>"Le Parrain",
                "annee"=>"1972-04-05",
                "acteur"=>"Marlon Brando, Al Pacino, James Caan",
                "description"=>"En 1945, à New York, les Corleone sont une des cinq familles de la mafia. Don Vito Corleone, \"parrain\" de cette famille, 
                marie sa fille à un bookmaker. Sollozzo, \" parrain \" de la famille Tattaglia, propose à Don Vito une association dans le trafic de drogue, 
                mais celui-ci refuse. Sonny, un de ses fils, y est quant à lui favorable.
                Afin de traiter avec Sonny, Sollozzo tente de faire tuer Don Vito, mais celui-ci en réchappe. Michael, le frère cadet de Sonny, recherche alors 
                les commanditaires de l'attentat et tue Sollozzo et le chef de la police, en représailles.
                Michael part alors en Sicile, où il épouse Apollonia, mais celle-ci est assassinée à sa place. De retour à New York, Michael épouse Kay Adams et 
                se prépare à devenir le successeur de son père...",
                "image"=>"parrain2.png",
                "video"=>"92e0eb5f125aa2b59a788674b8ca461c.mp4"
            ],
            [
                "titre"=>"Fight Club",
                "annee"=>"1999-03-01",
                "acteur"=>"Brad Pitt, Edward Norton, Helena Bonham Carter",
                "description"=>"Le narrateur, sans identité précise, vit seul, travaille seul, dort seul, mange seul ses plateaux-repas pour une personne comme 
                beaucoup d'autres personnes seules qui connaissent la misère humaine, morale et sexuelle. C'est pourquoi il va devenir membre du Fight club, 
                un lieu clandestin ou il va pouvoir retrouver sa virilité, l'échange et la communication. Ce club est dirigé par Tyler Durden, une sorte d'anarchiste 
                entre gourou et philosophe qui prêche l'amour de son prochain.",
                "image"=>"fight.png",
                "video"=>"92e0eb5f125aa2b59a788674b8ca461c.mp4"
            ],
        ];
        foreach ($films as $film){
            $filmInfo = new Film();
            $filmInfo
                ->setTitre($film['titre'])
                ->setAnnee(new \DateTime($film['annee']))
                ->setActeur($film['acteur'])
                ->setDescription($film['description'])
                ->setVideo($film['video'])
                ->setImage($film['image']);

            $manager->persist($filmInfo);
        }
        $manager->flush();
    }
}