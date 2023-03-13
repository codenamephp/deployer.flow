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

namespace de\codenamephp\deployer\flow\task\node;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Command that runs the repair command to bring nodes up to date (add new properties, set defaults, ...), fix structure, remove orphans etc.
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-contentrepository-node-repair
 * @psalm-api
 */
final class Repair extends AbstractFlowTask {

  public const NAME = 'flow:node:repair';

  public function __construct(public string       $nodeType = '',
                              public string       $workspace = '',
                              public bool         $dryRun = false,
                              public bool         $skipCleanup = false,
    /** @var array<string> */
                              public array        $skipChecks = [],
    /** @var array<string> */
                              public array        $onlyChecks = [],
                              iFlowCommandFactory $commandFactory = new WithBinaryFromDeployer(),
                              iRunner             $commandRunner = new WithDeployerFunctions()) {
    parent::__construct($commandFactory, $commandRunner);
  }

  public function getCommand() : string {
    return 'node:repair';
  }

  public function getArguments() : array {
    $params = array_filter([
      '--node-type' => $this->nodeType,
      '--workspace' => $this->workspace,
      '--dry-run' => $this->dryRun,
      '--cleanup' => $this->skipCleanup,
      '--skip' => implode(',', $this->skipChecks),
      '--only' => implode(',', $this->onlyChecks),
    ]);
    return array_map(static fn(string $name, string|bool $value) : string => is_string($value) ? sprintf('%s %s', $name, $value) : $name, array_keys($params), $params);
  }

  public function getDescription() : string {
    return 'Repair inconsistent nodes';
  }

  public function getName() : string {
    return self::NAME;
  }
}