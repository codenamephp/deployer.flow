<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\test\command\factory;

use de\codenamephp\deployer\base\functions\All;
use de\codenamephp\deployer\base\functions\iGet;
use de\codenamephp\deployer\command\Command;
use de\codenamephp\deployer\command\runConfiguration\SimpleContainer;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use PHPUnit\Framework\TestCase;

final class WithBinaryFromDeployerTest extends TestCase {

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

    $this->sut->deployer = $this->createMock(iGet::class);
    $this->sut->deployer
      ->expects(self::exactly(2))
      ->method('get')
      ->withConsecutive(
        ['flow:binary', '{{release_or_current_path}}/flow'],
        ['flow:context', '']
      )
      ->willReturnOnConsecutiveCalls('flow binary', 'flow context');

    $command = $this->sut->build('flow command', ['--some', '-arg'], ['FLOW_CONTEXT' => 'some context', 'some' => 'arg'], true, $runConfig);

    self::assertInstanceOf(Command::class, $command);
    self::assertSame('flow binary', $command->binary);
    self::assertSame(['flow command', '--some', '-arg'], $command->arguments);
    self::assertSame(['FLOW_CONTEXT' => 'some context', 'some' => 'arg'], $command->envVars);
    self::assertTrue($command->sudo);
    self::assertSame($runConfig, $command->getRunConfiguration());
  }

  public function testBuild_withMinimalArguments() : void {
    $this->sut->deployer = $this->createMock(iGet::class);
    $this->sut->deployer
      ->expects(self::exactly(2))
      ->method('get')
      ->withConsecutive(
        ['flow:binary', '{{release_or_current_path}}/flow'],
        ['flow:context', '']
      )
      ->willReturnOnConsecutiveCalls(null, null);

    $command = $this->sut->build('flow command');

    self::assertInstanceOf(Command::class, $command);
    self::assertSame('', $command->binary);
    self::assertSame(['flow command'], $command->arguments);
    self::assertSame(['FLOW_CONTEXT' => ''], $command->envVars);
    self::assertFalse($command->sudo);
    self::assertInstanceOf(SimpleContainer::class, $command->getRunConfiguration());
  }
}
