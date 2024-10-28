<?php
namespace PxpParser\Lexer\TokenEmulator;

use PhpParser\PhpVersion;
use PhpParser\Lexer\TokenEmulator\KeywordEmulator;

class InToken extends KeywordEmulator {

  public function getKeywordString(): string {
    return 'in';
  }
  public function getKeywordToken(): int {
    return \TX_IN;
  }
  public function getPhpVersion(): PhpVersion {
    return null; // not used
  }

}
