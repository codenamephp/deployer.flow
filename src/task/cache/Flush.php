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

namespace de\codenamephp\deployer\flow\task\cache;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Task to flush the cache
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-flow-cache-flush
 * @psalm-api
 */
final class Flush extends AbstractFlowTask {

  public const NAME = 'flow:cache:flush';

  public function __construct(public bool         $force = false,
                              iFlowCommandFactory $commandFactory = new WithBinaryFromDeployer(),
                              iRunner             $commandRunner = new WithDeployerFunctions()) {
    parent::__construct($commandFactory, $commandRunner);
  }

  public function getCommand() : string {
    return 'flow:cache:flush';
  }

  public function getArguments() : array {
    return $this->force ? ['--force'] : [];
  }

  public function getDescription() : string {
    return 'Flushes all configured caches.';
  }

  public function getName() : string {
    return self::NAME;
  }
}