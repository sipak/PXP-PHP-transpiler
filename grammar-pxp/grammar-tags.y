tag
  : TX_TAG_OPEN_BEGIN tag_name TX_TAG_SELF_END
                                          { $$ = Expr\StaticCall[Name["Tag"], $2, array()]; }
  | TX_TAG_OPEN_BEGIN tag_name TX_TAG_END
      tag_content_opt
    TX_TAG_CLOSE_BEGIN tag_name TX_TAG_END
                                          { $a = attributes(); $a['kind'] = Expr\Array_::KIND_SHORT;
                                            $content = count($4) > 1 ? [ new Expr\Array_($4, $a) ] : $4;
                                            $$ = Expr\StaticCall[Name["Tag"], $2, $content];
                                            if ($2->toString() !== $6->toString())
                                              $this->emitError(new Error("Unmatched tag name", attributes()));
                                          }
;

tag_name:
  identifier_maybe_reserved
;

tag_content_opt:
  tag_content
  | /* empty */                           { init(); }
;

tag_content:
  tag_content tag_expr                    { push($1, $2); }
  | tag_expr                              { init($1); }
;

tag_expr:
  tag
  | expr                                  { $$ = $1; }
;
