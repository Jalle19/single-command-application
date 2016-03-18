<?php

namespace Jalle19\SingleCommandApplication;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;

/**
 * Class SingleCommandApplication
 * @package   Jalle19\SingleCommandApplication
 * @copyright Copyright &copy; Sam Stenvall 2015-
 * @license   https://www.gnu.org/licenses/gpl.html The GNU General Public License v2.0
 */
class SingleCommandApplication extends Application
{

    /**
     * @var string the name of the command to run
     */
    private $_commandName;

    /**
     * @var mixed the command class
     */
    private $_commandClass;


    /**
     * SingleCommandApplication constructor.
     *
     * @param string $commandName  the name of the command
     * @param string $commandClass the ::class implementing the command
     * @param string $name
     * @param string $version
     */
    public function __construct($commandName, $commandClass, $name = 'UNKNOWN', $version = 'UNKNOWN')
    {
        $this->_commandName  = $commandName;
        $this->_commandClass = $commandClass;

        parent::__construct($name, $version);
    }


    /**
     * @inheritdoc
     */
    protected function getCommandName(InputInterface $input)
    {
        return $this->_commandName;
    }


    /**
     * @inheritdoc
     */
    protected function getDefaultCommands()
    {
        $defaultCommands   = parent::getDefaultCommands();
        $defaultCommands[] = new $this->_commandClass;

        return $defaultCommands;
    }


    /**
     * @inheritdoc
     */
    public function getDefinition()
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }
}
