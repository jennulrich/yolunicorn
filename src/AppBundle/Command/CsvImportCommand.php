<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 02/03/2018
 * Time: 11:14
 */

namespace AppBundle\Command;

use AppBundle\Entity\Film;
use AppBundle\Entity\Genre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use League\Csv\Reader;

class CsvImportCommand extends Command
{
    private $em;

    public function __construct($name = null, entityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        parent::__construct($name = null);
    }

    public function configure()
    {
        $this
            ->setName("app:csv:importFilms")
            ->setDescription("Create Import Films")
            ->setHelp("Cette commande permet d'importer des films en masse (csv file)");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $io->title("Import en cours...");

        /** @var Reader $reader */
        $reader = Reader::createFromPath("%kernel.root_dir%/../src/AppBundle/Data/Films.csv", "r");

        $results = $reader->getRecords();

        $i = 0;
        foreach ($results as $row) {
            if ($i++ == 0) {
                continue;
            }
            var_dump($row);
             $film = (new Film())
                ->setTitre($row[0])
                ->setAnnee(new \DateTime($row[1]))
                ->setActeur($row[2])
                ->setDescription($row[3])
                ->setImage($row[4])
                ->setVideo($row[5]);

            $this->em->persist($film);

            $genre = (new Genre())
                ->setGenreCat($row[6]);

            $this->em->persist($genre);

            $film->addGenre($genre);
        }

        $this->em->flush();

        $io->success("Everything is OK ;-) .... YOLOOOO ");
    }
}