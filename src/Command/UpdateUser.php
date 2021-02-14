<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\Culture\Project;
use App\Entity\Culture\TestResult;
use App\Entity\User;
use App\Message\Command\Culture\CreteTestResultFromReturnedCandidate;
use App\Repository\Culture\TestResultRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class UpdateUser extends Command
{
    protected static $defaultName = 'app:user:update';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
        $this->addArgument('username', InputArgument::REQUIRED);
        $this->addArgument('email', InputArgument::REQUIRED);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['username'=>$input->getArgument('username')]);
        if (!$user instanceof User) {
            $output->writeln('Could not find user');
            return 1;
        }

        $user->setEmail($input->getArgument('email'));
        $this->em->flush();

        return 0;
    }
}
