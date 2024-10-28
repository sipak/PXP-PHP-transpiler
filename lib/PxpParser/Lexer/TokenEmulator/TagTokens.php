<?php declare(strict_types=1);

namespace PxpParser\Lexer\TokenEmulator;
use PhpParser\Token;

class TagTokens extends TokenEmulator {

  public function emulate(string $code, array $tokens): array {
    for ($i = 0, $c = count($tokens); $i < $c; ++$i) {
      $token = &$tokens[$i];
      // <div
      if ( $token->text === '<' && $tokens[$i + 1]?->id === \T_STRING ) {
        $token->id = \TX_TAG_OPEN_BEGIN;
        continue;
      }
      // </div
      if ( $token->text === '<' && $tokens[$i + 1]?->text === '/' ) {
        array_splice($tokens, $i, 2, [
            new Token(\TX_TAG_CLOSE_BEGIN, '</', $token->line, $token->pos),
        ]);
        $c--;
        continue;
      }
      // ...> or .../>
      if ( $token->text === '>' && $tokens[$i - 1]?->id != \T_WHITESPACE && !str_contains('=->', $tokens[$i - 1]?->text) ) {
        $token->id = \TX_TAG_END;
        continue;
      }
      if ( $token->text === '/' && $tokens[$i + 1]?->text === '>' ) {
        array_splice($tokens, $i, 2, [
            new Token(\TX_TAG_SELF_END, '/>', $token->line, $token->pos),
        ]);
        $c--;
        continue;
      }
    }
    return $tokens;
  }

  // public function preprocessCode(string $code, array &$patches): string {
  //   $pos = 0;
  //   while (false !== $pos = strpos($code, '#[', $pos)) {
  //     // Replace #[ with %[
  //     $code[$pos] = '%';
  //     $patches[] = [$pos, 'replace', '#'];
  //     $pos += 2;
  //   }
  //   return $code;
  // }

}
