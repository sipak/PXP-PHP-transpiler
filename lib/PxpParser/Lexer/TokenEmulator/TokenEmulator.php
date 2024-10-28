<?php declare(strict_types=1);

namespace PxpParser\Lexer\TokenEmulator;

use PhpParser\PhpVersion;
use PhpParser\Token;

/** @internal */
abstract class TokenEmulator extends \PhpParser\Lexer\TokenEmulator\TokenEmulator {

  abstract public function emulate(string $code, array $tokens): array;

  public function isEmulationNeeded(string $code): bool {
    return true;
  }
  public function getPhpVersion(): PhpVersion {
    assert(false);
  }
  public function reverseEmulate(string $code, array $tokens): array {
    assert(false);
  }

}
