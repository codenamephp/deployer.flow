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

namespace de\codenamephp\deployer\flow\test\task\cache;

use de\codenamephp\deployer\flow\task\cache\Warmup;
use PHPUnit\Framework\TestCase;

final class WarmupTest extends TestCase {

  private Warmup $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Warmup();
  }

  public function testGetCommand() : void {
    self::assertSame('cache:warmup', $this->sut->getCommand());
  }

  public function testGetArguments() : void {
    self::assertSame([], $this->sut->getArguments());
  }
}
