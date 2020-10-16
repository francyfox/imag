<?php


namespace App\Commands;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Services\Helper;


class Console
{
    private $isRun;

    public function execute(array $bash)
    {
        set_time_limit(0);
        $response = new StreamedResponse();
        $process = new Process($bash);
        $process->stop();
        $process->setWorkingDirectory('/home/imag2');


        try {
            $process->mustRun();
            $response->setCallback(function() use ($process) {
                $process->run(function ($type, $buffer) {
                    if (Process::ERR === $type) {
                        echo 'ERR > '.$buffer;
                    } else {
                        echo 'OUT > '.$buffer;
                        echo '<br>';
                    }
                });
            });
            $response->setStatusCode(200);
            return $response;
        } catch (ProcessFailedException $exception) {
            return $exception->getMessage();
        }
    }

    public function isRunning()
    {
        return $this->isRun;
    }
}