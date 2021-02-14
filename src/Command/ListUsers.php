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
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;

class ListUsers extends Command
{
    protected static $defaultName = 'app:user:list';

    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure()
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $users = $this->em->getRepository(User::class)->findAll();

        $rows = [];
        /** @var User $user */
        foreach ($users as $user) {
            $rows[] = [$user->getId(), $user->getUsername(), $user->getEmail()];
        }

        $io = new SymfonyStyle($input, $output);
        $io->table(['Id', 'Username', 'Email'], $rows);

        return 0;
    }
}
