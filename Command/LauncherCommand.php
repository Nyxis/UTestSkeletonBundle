<?php
namespace UTest\SkeletonBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\Command;

/**
 * command to run the unit test generation
 */
class LauncherCommand extends Command
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this->setName('utest:generate');

        // $this->addOption('no-git', null, InputOption::VALUE_NONE, 'No git update');
        // $this->addOption('run-unit', null, InputOption::VALUE_NONE, 'Run unit tests');
        // $this->addOption('run-selenium', null, InputOption::VALUE_NONE, 'Run selenium tests');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>YProximitie build</info>');
        // do as you want
    }
}