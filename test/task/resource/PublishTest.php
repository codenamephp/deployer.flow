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

namespace de\codenamephp\deployer\flow\test\task\resource;

use de\codenamephp\deployer\flow\task\resource\Publish;
use PHPUnit\Framework\TestCase;

final class PublishTest extends TestCase {

  private Publish $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Publish();
  }

  public function testGetCommand() : void {
    self::assertSame('resource:publish', $this->sut->getCommand());
  }

  public function testGetArguments() : void {
    self::assertSame([], $this->sut->getArguments());
  }
}
