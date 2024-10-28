<?

//
// before
foreach ( range(1, 999) as $number ) {
  if ( $number % 3 && $number % 5 ) continue;
  @$result += $number;
}

// transformed
$result = array_reduce(range(1, 999), fn($c, $n) => $c + ($n%3 && $n%5) ? $c + $n : 0);

// in the process
$result = array_reduce(range(1, 999), $a + ($b % 3 && $b % 5) ? $a + $b : 0);

// most reduced using array operations
$result = sum .| range(1, 999).skip($$ % 3 && $$ % 5);

//
// before
$fn = match (server::GET('type')) {
  'round'     => fn($a) => round($a),
  'increase'  => fn($a) => $a+1,
  'decrease'  => fn($a) => $a-1,
};

// in the process
$fn = match (server::GET('type')) {
  'round'     => round($$),
  'increase'  => $$+1,
  'decrease'  => $$-1,
};

// after
fn = match server::GET('type') {
  'round'     => round($)
  'increase'  => $+1
  'decrease'  => $-1
}

// most reduced
fn = match server::GET 'type'
  'round'    round $
  'increase' $+1
  'decrease' $-1
