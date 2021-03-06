<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\test\task\cache;

use de\codenamephp\deployer\command\runner\iRunner;
use de\codenamephp\deployer\command\runner\WithDeployerFunctions;
use de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory;
use de\codenamephp\deployer\flow\command\factory\WithBinaryFromDeployer;
use de\codenamephp\deployer\flow\task\cache\Flush;
use PHPUnit\Framework\TestCase;

final class FlushTest extends TestCase {

  private Flush $sut;

  protected function setUp() : void {
    parent::setUp();

    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);

    $this->sut = new Flush(commandFactory: $commandFactory, commandRunner: $commandRunner);
  }

  public function test__construct() : void {
    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);

    $this->sut = new Flush(true, $commandFactory, $commandRunner);

    self::assertTrue($this->sut->force);
    self::assertSame($commandRunner, $this->sut->commandRunner);
    self::assertSame($commandFactory, $this->sut->commandFactory);
  }

  public function test__construct_withMinmalArguments() : void {
    $this->sut = new Flush();

    self::assertFalse($this->sut->force);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->commandRunner);
    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
  }

  public function testGetArguments() : void {
    self::assertEquals([], $this->sut->getArguments());
  }

  public function testGetArguments_withForce() : void {
    $this->sut->force = true;

    self::assertEquals(['--force'], $this->sut->getArguments());
  }

  public function testGetCommand() : void {
    self::assertEquals('flow:cache:flush', $this->sut->getCommand());
  }
}
