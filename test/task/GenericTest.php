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

namespace de\codenamephp\deployer\flow\test\task;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\Generic;
use PHPUnit\Framework\TestCase;

final class GenericTest extends TestCase {

  private Generic $sut;

  protected function setUp() : void {
    parent::setUp();

    $this->sut = new Generic('', '');
  }

  public function test__construct() : void {
    $command = 'some command';
    $arguments = ['some', 'arguments'];
    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);
    $taskName = 'some task name';
    $taskDescription = 'some task description';

    $this->sut = new Generic($command, $taskName, $arguments, $taskDescription, $commandFactory, $commandRunner);

    self::assertSame($command, $this->sut->getCommand());
    self::assertSame($arguments, $this->sut->getArguments());
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($commandRunner, $this->sut->commandRunner);
    self::assertSame($taskDescription, $this->sut->getDescription());
    self::assertSame($taskName, $this->sut->getName());
  }

  public function test__construct_withoutOptionalArguments() : void {
    $command = 'some command';
    $taskName = 'some task name';

    $this->sut = new Generic($command, $taskName);

    self::assertSame($command, $this->sut->getCommand());
    self::assertSame([], $this->sut->getArguments());
    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->commandRunner);
    self::assertSame($taskName, $this->sut->getName());
    self::assertSame('', $this->sut->getDescription());
  }

  public function testGetCommand() : void {
    $this->sut->command = 'some command';

    self::assertSame('some command', $this->sut->getCommand());
  }

  public function testGetArguments() : void {
    $this->sut->arguments = ['some', 'arguments'];

    self::assertSame(['some', 'arguments'], $this->sut->getArguments());
  }
}
