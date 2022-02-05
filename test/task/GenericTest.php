<?php declare(strict_types=1);

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

    $this->sut = new Generic('');
  }

  public function test__construct() : void {
    $command = 'some command';
    $arguments = ['some', 'arguments'];
    $commandFactory = $this->createMock(iFlowCommandFactory::class);
    $commandRunner = $this->createMock(iRunner::class);

    $this->sut = new Generic($command, $arguments, $commandFactory, $commandRunner);

    self::assertSame($command, $this->sut->getCommand());
    self::assertSame($arguments, $this->sut->getArguments());
    self::assertSame($commandFactory, $this->sut->commandFactory);
    self::assertSame($commandRunner, $this->sut->commandRunner);
  }

  public function test__construct_withoutOptionalArguments() : void {
    $command = 'some command';

    $this->sut = new Generic($command);

    self::assertSame($command, $this->sut->getCommand());
    self::assertSame([], $this->sut->getArguments());
    self::assertInstanceOf(WithBinaryFromDeployer::class, $this->sut->commandFactory);
    self::assertInstanceOf(WithDeployerFunctions::class, $this->sut->commandRunner);
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
