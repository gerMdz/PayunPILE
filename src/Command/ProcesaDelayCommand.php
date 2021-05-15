<?php

namespace App\Command;

use App\Service\Handler\DelayMail\HandlerDelayMail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class ProcesaDelayCommand extends Command
{
    protected static $defaultName = 'app:procesa-delay';
    protected static string $defaultDescription = 'Procesa los datos de delayMail';

    private HandlerDelayMail $delayMail;

    protected function configure()
    {
        $this
            ->setDescription(self::$defaultDescription)
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    public function __construct(HandlerDelayMail $delayMail)
    {
        parent::__construct();
        $this->delayMail = $delayMail;

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        $output->writeln([
            'Procesando DelayMail',
            '============',
            '',
        ]);

        $this->delayMail->enviaMail();


        $output->writeln('Delay Procesado!');
        $io->success('Ok.');

        return 0;
    }
}
