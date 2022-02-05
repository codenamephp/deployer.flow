<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\task;

use de\codenamephp\deployer\base\task\iTask;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;

/**
 * Base task for flow tasks. Extending tasks just need to set the command and arguments
 *
 * The flow command is created with the command factory using the command and arguments and run using the command runner
 */
abstract class AbstractFlowTask implements iTask {

  public function __construct(public iFlowCommandFactory $commandFactory = new WithBinaryFromDeployer(), public iRunner $commandRunner = new WithDeployerFunctions()) { }

  /**
   * The flow command to run, e.g. 'flow:cache:flush'
   *
   * @return string
   */
  abstract public function getCommand() : string;

  /**
   * The arguments to run the command with, e.g. ['--force', '-v']
   *
   * @return array<int, string>
   */
  abstract public function getArguments() : array;

  public function __invoke() : void {
    $this->commandRunner->run($this->commandFactory->build($this->getCommand(), $this->getArguments()));
  }
}