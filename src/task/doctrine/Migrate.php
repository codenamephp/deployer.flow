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

namespace de\codenamephp\deployer\flow\task\doctrine;

use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Runs the doctrine migrations
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-flow-doctrine-migrate
 * @psalm-api
 */
final class Migrate extends AbstractFlowTask {

  public const NAME = 'flow:doctrine:migrate';

  public function getCommand() : string {
    return 'doctrine:migrate';
  }

  public function getArguments() : array {
    return [];
  }

  public function getDescription() : string {
    return 'Runs the doctrine database migrations';
  }

  public function getName() : string {
    return self::NAME;
  }
}