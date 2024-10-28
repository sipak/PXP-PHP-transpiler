<?php

namespace PxpParser;

use PhpParser\PhpVersion;
use PhpParser\Parser;
use PxpParser\Parser\Pxp;
use PxpParser\Lexer\Emulative;

define('TX_TOKENS', [
  1001 => 'TX_IN',                  // in keyword
  1002 => 'TX_TAG_OPEN_BEGIN',      // <...
  1003 => 'TX_TAG_CLOSE_BEGIN',     // </...
  1004 => 'TX_TAG_END',             // ...>
  1005 => 'TX_TAG_SELF_END',        // .../>
]);
foreach ( TX_TOKENS as $id => $name ) {
  define($name, $id);
}

class ParserFactory {
  public function create(): Parser {
    return new Pxp(new Emulative, PhpVersion::getHostVersion());
  }
}
