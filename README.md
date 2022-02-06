# deployer.flow

![Packagist Version](https://img.shields.io/packagist/v/codenamephp/deployer.flow)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/codenamephp/deployer.flow)
![Lines of code](https://img.shields.io/tokei/lines/github/codenamephp/deployer.flow)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/codenamephp/deployer.flow)
![CI](https://github.com/codenamephp/deployer.flow/workflows/CI/badge.svg)
![Packagist Downloads](https://img.shields.io/packagist/dt/codenamephp/deployer.flow)
![GitHub](https://img.shields.io/github/license/codenamephp/deployer.flow)

## What is it?

This package provides deployer task for the flow framework.

## Installation

Easiest way is via composer. Just run `composer require codenamephp/deployer.flow` in your cli which should install the latest version for you.

## Usage

First you need to add the `flow:context` configuration to each host according to your context names.

Then just use the provided tasks in your deployer file or extend the `\de\codenamephp\deployer\flow\task\AbstractFlowTask` and use the
`\de\codenamephp\deployer\flow\command\factory\iFlowCommandFactory` to run commands.