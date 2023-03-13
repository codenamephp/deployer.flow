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

use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\AbstractFlowTask;
use PHPUnit\Framework\TestCase;

final class AbstractFlowTaskTest extends TestCase {

  private AbstractFlowTask $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);

    $this->sut = $this->getMockForAbstractClass(AbstractFlowTask::class, [$commandFactory, $commandRunner]);
  }

  public function test__invoke() : void {
    $this->sut->expects(self::once())->method('getCommand')->willReturn('some command');
    $this->sut->expects(self::once())->method('getArguments')->willReturn(['some', 'arguments']);

    $command = $this->createMock(iCommand::class);

    $this->sut->commandFactory = $this->createMock(iFlowCommandFactory::class);
    $this->sut->commandFactory->expects(self::once())->method('build')->with('some command', ['some', 'arguments'])->willReturn($command);

    $this->sut->commandRunner = $this->createMock(iRunner::class);
    $this->sut->commandRunner->expects(self::once())->method('run')->with($command);

    $this->sut->__invoke();
  }

  public function test__construct() : void {
    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);

    $this->sut = $this->getMockForAbstractClass(AbstractFlowTask::class, [$commandFactory, $commandRunner]);

    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($commandRunner, $this->sut->commandRunner);
  }

  public function test__construct_withoutOptionalArguments() : void {
    $this->sut = $this->getMockForAbstractClass(AbstractFlowTask::class);

    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->commandRunner);
  }
}
