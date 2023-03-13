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

use de\codenamephp\deployer\base\task\iTaskWithDescription;
use de\codenamephp\deployer\base\task\iTaskWithName;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;

/**
 * Base task for flow tasks. Extending tasks just need to set the command and arguments
 *
 * The flow command is created with the command factory using the command and arguments and run using the command runner
 */
abstract class AbstractFlowTask implements iTaskWithName, iTaskWithDescription {

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