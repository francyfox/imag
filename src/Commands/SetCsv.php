<?php


namespace App\Commands;

use Symfony\Component\Console\Command\Command;
use Wrep\Daemonizable\Command\EndlessContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use App\Services\csv;
use App\Services\Helper;


class SetCsv extends EndlessContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('add:csv')
            ->setDescription('Add csv data2msql')
            ->setTimeout(1.5);
    }

    protected function initialize(InputInterface $input, OutputInterface $output)
    {
        // Do one time initialization here
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $rootdir = '/home/imag2';  // TODO:CHANGE PATH
        $getCsv = file_get_contents($rootdir.'/public/CsvPath');
        $path = unserialize($getCsv);
        $debug = xdebug_var_dump(csv::SetCsv($path));
        $output->writeln($debug);
        return Command::SUCCESS;
    }


}