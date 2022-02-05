<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\task;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;

/**
 * A generic task that takes the command and arguments as constructor parameters. Can be used for custom commands or for testing. For commands that used
 * regularly you should create actual task classes
 */
final class Generic extends AbstractFlowTask {

  public function __construct(public string       $command,
    /** @var array<int,string> */
                              public array        $arguments = [],
                              iFlowCommandFactory $commandFactory = new WithBinaryFromDeployer(),
                              iRunner             $commandRunner = new WithDeployerFunctions()) {
    parent::__construct($commandFactory, $commandRunner);
  }

  public function getCommand() : string {
    return $this->command;
  }

  public function getArguments() : array {
    return $this->arguments;
  }
}