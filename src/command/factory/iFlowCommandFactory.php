<?php declare(strict_types=1);

namespace de\codenamephp\deployer\flow\command\factory;

use de\codenamephp\deployer\command\iCommand;
use de\codenamephp\deployer\command\runConfiguration\iRunConfiguration;

/**
 * Factory to create flow commands. Implementations must take care of getting the correct flow binary and flow context and should take care of
 * setting the working directory
 */
interface iFlowCommandFactory {

  /**
   * Implementations MUST make sure the command gets the correct binary (e.g. from deployer) and that all parameters are passed on correctly
   *
   * @param string $command The flow command to run, e.g. 'install' or 'update'
   * @param array<int, string> $arguments Array of arguments to pass to the command with numerical indexes so the arguments can be expanded, e.g. ['--no-dev', '-v']
   * @param array<string, string> $envVars Array of env vars to pass to the command with the name as key.
   * @param bool $sudo Flag if the command should be executed as root
   * @param iRunConfiguration|null $runConfiguration The run configuration for the command. Defaults to an empty configuration
   * @return iCommand The command to run
   */
  public function build(string $command, array $arguments = [], array $envVars = [], bool $sudo = false, iRunConfiguration $runConfiguration = null) : iCommand;
}