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

namespace de\codenamephp\deployer\flow\test\command\factory;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use PHPUnit\Framework\TestCase;

final class WithBinaryFromDeployerTest extends TestCase {

  use MockeryPHPUnitIntegration;

  private WithBinaryFromDeployer $sut;

  protected function setUp() : void {
    parent::setUp();

    $deployer = $this->createMock(iGet::class);

    $this->sut = new WithBinaryFromDeployer($deployer);
  }

  public function test__construct() : void {
    $this->sut = new WithBinaryFromDeployer();

    self::assertInstanceOf(All::class, $this->sut->deployer);
  }

  public function testBuild() : void {
    $runConfig = new SimpleContainer(123);

    $this->sut->deployer = Mockery::mock(iGet::class);
    $this->sut->deployer->allows('get')->once()->ordered()->with('flow:binary', '{{release_or_current_path}}/flow')->andReturn('flow binary');
    $this->sut->deployer->allows('get')->once()->ordered()->with('flow:context', '')->andReturn('flow context');

    $command = $this->sut->build('flow command', ['--some', '-arg'], ['FLOW_CONTEXT' => 'some context', 'some' => 'arg'], true, $runConfig);

    self::assertInstanceOf(Command::class, $command);
    self::assertSame('flow binary', $command->binary);
    self::assertSame(['flow command', '--some', '-arg'], $command->arguments);
    self::assertSame(['FLOW_CONTEXT' => 'some context', 'some' => 'arg'], $command->envVars);
    self::assertTrue($command->sudo);
    self::assertSame($runConfig, $command->getRunConfiguration());
  }

  public function testBuild_withMinimalArguments() : void {
    $this->sut->deployer = Mockery::mock(iGet::class);
    $this->sut->deployer->allows('get')->once()->ordered()->with('flow:binary', '{{release_or_current_path}}/flow')->andReturn(null);
    $this->sut->deployer->allows('get')->once()->ordered()->with('flow:context', '')->andReturn(null);

    $command = $this->sut->build('flow command');

    self::assertInstanceOf(Command::class, $command);
    self::assertSame('', $command->binary);
    self::assertSame(['flow command'], $command->arguments);
    self::assertSame(['FLOW_CONTEXT' => ''], $command->envVars);
    self::assertFalse($command->sudo);
    self::assertInstanceOf(SimpleContainer::class, $command->getRunConfiguration());
  }
}
