<?php

namespace PxpParser\Lexer;

use PhpParser\PhpVersion;
use PxpParser\Lexer\TokenEmulator\InToken;
use PxpParser\Lexer\TokenEmulator\TagTokens;

class Emulative extends \PhpParser\Lexer\Emulative {

  public function __construct() {
    parent::__construct(PhpVersion::getHostVersion());
    // accessing private $emulators in the parent class
    $emulators = (new \ReflectionClass($this))->getParentClass()->getProperty('emulators');
    $emulators->setAccessible(true);
    $emulators->setValue($this, array_merge($emulators->getValue($this), [
      new InToken,
      new TagTokens,
    ]));
  }

}
