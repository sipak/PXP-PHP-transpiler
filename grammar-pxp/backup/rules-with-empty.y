top_statement_list:
    top_statement_list_ex                       { makeZeroLengthNop($nop);
                                                  if ($nop !== null) { $1[] = $nop; } $$ = $1; }
;
top_statement_list_ex:
    top_statement_list_ex top_statement         { pushNormalizing($1, $2); }
    | /* empty */                               { init(); }
;

inner_statement_list:
    inner_statement_list_ex                     { makeZeroLengthNop($nop);
                                                  if ($nop !== null) { $1[] = $nop; } $$ = $1; }
;
inner_statement_list_ex:
    inner_statement_list_ex inner_statement     { pushNormalizing($1, $2); }
    | /* empty */                               { init(); }
;

class_statement_list_ex:
    class_statement_list_ex class_statement     { if ($2 !== null) { push($1, $2); } else { $$ = $1; } }
    | /* empty */                               { init(); }
;
class_statement_list:
    class_statement_list_ex                     { makeZeroLengthNop($nop);
                                                  if ($nop !== null) { $1[] = $nop; } $$ = $1; }
;


elseif_list:
  /* empty */                                   { init(); }
  | elseif_list elseif                          { push($1, $2); }
;

else_single:
  /* empty */                                               { $$ = null; }
  | T_ELSE '{' inner_statement_list '}'                     { $$ = Stmt\Else_[$3]; }
;

statement:
      non_empty_statement
    | ';'                                                   { makeNop($$); }
;

catches:
      /* empty */                                           { init(); }
    | catches catch                                         { push($1, $2); }
;

optional_finally:
      /* empty */                                           { $$ = null; }
    | T_FINALLY '{' inner_statement_list '}'                { $$ = Stmt\Finally_[$3]; }
;

no_comma:
    /* empty */                               { /* nothing */ }
    | ','                                     { $this->emitError(new Error('A trailing comma is not allowed here', attributes())); }
;

optional_comma:
    /* empty */
    | ','
;

variables_list:
      non_empty_variables_list optional_comma
;

non_empty_variables_list:
      variable                                              { init($1); }
    | non_empty_variables_list ',' variable                 { push($1, $3); }
;

optional_attributes:
      /* empty */                             { $$ = []; }
    | attributes
;

optional_ref:
      /* empty */                                           { $$ = false; }
    | ampersand                                             { $$ = true; }
;

optional_arg_ref:
      /* empty */                                           { $$ = false; }
    | T_AMPERSAND_FOLLOWED_BY_VAR_OR_VARARG                 { $$ = true; }
;

optional_ellipsis:
      /* empty */                                           { $$ = false; }
    | T_ELLIPSIS                                            { $$ = true; }
;

enum_scalar_type:
      /* empty */                                           { $$ = null; }
    | ':' type                                              { $$ = $2; }

enum_case_expr:
      /* empty */                                           { $$ = null; }
    | '=' expr                                              { $$ = $2; }
;

extends_from:
      /* empty */                                           { $$ = null; }
    | T_EXTENDS class_name                                  { $$ = $2; }
;

interface_extends_list:
      /* empty */                                           { $$ = array(); }
    | T_EXTENDS class_name_list                             { $$ = $2; }
;

implements_list:
      /* empty */                                           { $$ = array(); }
    | T_IMPLEMENTS class_name_list                          { $$ = $2; }
;

case_list:
      /* empty */                                           { init(); }
    | case_list case                                        { push($1, $2); }
;

match_arm_list:
      /* empty */                                           { $$ = []; }
    | non_empty_match_arm_list optional_comma
;
non_empty_match_arm_list:
      match_arm                                             { init($1); }
    | non_empty_match_arm_list ',' match_arm                { push($1, $3); }
;
match_arm:
      expr_list_allow_comma T_DOUBLE_ARROW expr             { $$ = Node\MatchArm[$1, $3]; }
    | T_DEFAULT optional_comma T_DOUBLE_ARROW expr          { $$ = Node\MatchArm[null, $4]; }
;

parameter_list:
      non_empty_parameter_list optional_comma
    | /* empty */                                           { $$ = array(); }
;
non_empty_parameter_list:
      parameter                                             { init($1); }
    | non_empty_parameter_list ',' parameter                { push($1, $3); }
;

optional_property_modifiers:
      /* empty */               { $$ = 0; }
    | optional_property_modifiers property_modifier
          { $this->checkModifier($1, $2, #2); $$ = $1 | $2; }
;

optional_type_without_static:
      /* empty */                                           { $$ = null; }
    | type_expr_without_static
;

optional_return_type:
      /* empty */                                           { $$ = null; }
    | ':' type_expr                                         { $$ = $2; }
    | ':' error                                             { $$ = null; }
;

trait_adaptations:
      ';'                                                   { $$ = array(); }
    | '{' trait_adaptation_list '}'                         { $$ = $2; }
;

trait_adaptation_list:
      /* empty */                                           { init(); }
    | trait_adaptation_list trait_adaptation                { push($1, $2); }
;
