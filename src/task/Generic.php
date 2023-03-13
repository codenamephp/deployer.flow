<?php declare(strict_types=1);
/*
 *   Copyright 2023 Bastian Schwarz <bastian@codename-php.de>.
 *
 *   Licensed under the Apache License, Version 2.0 (the "License");
 *   you may not use this file except in compliance with the License.
 *   You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 *   Unless required by applicable law or agreed to in writing, software
 *   distributed under the License is distributed on an "AS IS" BASIS,
 *   WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 *   See the License for the specific language governing permissions and
 *   limitations under the License.
 */

namespace de\codenamephp\deployer\flow\task;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;

/**
 * A generic task that takes the command and arguments as constructor parameters. Can be used for custom commands or for testing. For commands that used
 * regularly you should create actual task classes
 *
 * @psalm-api
 */
final class Generic extends AbstractFlowTask {

  public function __construct(public string       $command,
                              public string       $taskName,
    /** @var array<int,string> */
                              public array        $arguments = [],
                              public string       $taskDescription = '',
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

  public function getDescription() : string {
    return $this->taskDescription;
  }

  public function getName() : string {
    return $this->taskName;
  }
}