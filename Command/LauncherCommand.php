<?php
namespace UTest\SkeletonBundle\Command;

require_once dirname(__FILE__).'/../vendor/utest/lib/utest/Skeleton.class.php';

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\ClassLoader\UniversalClassLoader;

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
        $this->addArgument('classes', InputArgument::REQUIRED, 'Class which have test to be generate');
    }

    /**  */
    protected $output;

    /**
     *
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;

        try {
            \Skeleton::create()
                ->useTestEngine('php_unit')
                ->bind('log', array($this, 'sendLog'))
                ->run($input->getArgument('classes'));
        }
        catch(InvalidArgumentException $e) {
            echo "\n"; $this->logBlock($e->getMessage().' -- abording task.', 'ERROR'); echo "\n";

            return -1;
        }

        return 0;
    }

    /**
     * callback for log event in skeleton classes
     */
    public function sendLog($label, $msg, $style = 'info')
    {
        $this->output->writeln(sprintf('>>> <%s>%s</%s>%s%s',
            $style,
            $label,
            $style,
            str_repeat(' ', 10-strlen($label)),
            $msg
        ));
    }
}