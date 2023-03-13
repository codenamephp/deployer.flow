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

use de\codenamephp\deployer\flow\task\AbstractFlowTask;

/**
 * Flow command to warmup caches
 *
 * @see https://neos.readthedocs.io/en/stable/References/CommandReference.html#neos-flow-cache-warmup
 * @psalm-api
 */
final class Warmup extends AbstractFlowTask {

  public const NAME = 'flow:cache:warmup';

  public function getCommand() : string {
    return 'cache:warmup';
  }

  public function getArguments() : array {
    return [];
  }

  public function getDescription() : string {
    return 'Fills caches for the next request.';
  }

  public function getName() : string {
    return self::NAME;
  }
}