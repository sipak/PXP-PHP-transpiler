<?php declare(strict_types=1);

namespace PhpParser;

use PhpParser\Parser\Pxp;

class PxpParserFactory {
  public function create(): Parser {
    $version = PhpVersion::getHostVersion();
    $lexer = $version->isHostVersion() ? new Lexer() : new Lexer\Emulative($version);
    return new Pxp($lexer, $version);
  }
}
