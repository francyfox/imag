<?php

declare(strict_types=1);

namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class StartApp extends Command
{
    /**
     * @Cron(minute="/2", noLogs=true)
     */
    protected function configure()
    {
        $this
            ->setName('srv:start')
            ->setDescription('Start server with all dependecies');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {

    }
}