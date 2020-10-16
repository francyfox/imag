<?php

declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;



class StartApp extends Command
{
    protected function configure()
    {
        $this
            ->setName('srv:start')
            ->setDescription('Start server with all dependecies');

    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        exec('systemctl start mariadb', $out);
        $output->writeln($out);
        exec('symfony server:start', $out);
        $output->writeln($out);
        return Command::SUCCESS;
    }
}