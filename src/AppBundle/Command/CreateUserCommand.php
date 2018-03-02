<?php
/**
 * Created by PhpStorm.
 * User: jennou
 * Date: 02/03/2018
 * Time: 09:44
 */
namespace AppBundle\Command;

use AppBundle\Manager\UserManager;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName("app:create:user")
            ->setDescription("Create user")
            ->setHelp("Cette commande vous permet de créer un utilisateur")
            ->addArgument("nom", InputArgument::REQUIRED, "nom")
            ->addArgument("prenom", InputArgument::REQUIRED, "prenom")
            ->addArgument("age", InputArgument::REQUIRED, "age")
            ->addArgument("email", InputArgument::REQUIRED, "email")
            ->addArgument("pseudo", InputArgument::REQUIRED, "pseudo")
            ->addArgument("password", InputArgument::REQUIRED, "password")
            ->addArgument("is_admin", InputArgument::REQUIRED, "is_admin");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
                "<fg=white;bg=green>Create user</>\n",
                "=<fg=magenta>**</>=u=n=i=c=o=r=n=<fg=magenta>**</>=",
                "",
            ]);
        $output->writeln("<fg=white;bg=blue>Whoaaaaa !</>\n");

        $output->write("<fg=magenta;bg=black>Tu es sur le point de créer une... </>");
        $output->write("<fg=magenta;bg=black;options=bold>LICORNE !!</>\n");

        $output->writeln("nom : ".$input->getArgument("nom"));
        $output->writeln("prenom : ".$input->getArgument("prenom"));
        $output->writeln("age : ".$input->getArgument("age"));
        $output->writeln("email : ".$input->getArgument("email"));
        $output->writeln("pseudo : ".$input->getArgument("pseudo"));
        $output->writeln("password : ".$input->getArgument("password"));
        $output->writeln("is_admin : ".$input->getArgument("is_admin"));

        $this->userManager->createUser(
            $input->getArgument("nom"),
            $input->getArgument("prenom"),
            $input->getArgument("age"),
            $input->getArgument("email"),
            $input->getArgument("pseudo"),
            $input->getArgument("password"),
            $input->getArgument("is_admin")
        );

        $output->writeln("<fg=white;bg=magenta>Ta Licorne a bien été créée :D</>\n");
    }
}