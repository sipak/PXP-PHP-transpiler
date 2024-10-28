<?php

for $order in $orders {
  echo $order;
}

for $array as $v {
  echo $v;
}

match {
  true => 'yes',
  false => 'no',
};

match $v {
  '1' => value1(),
  default => value3(),
};

if $v {
  echo 'if';
} elseif $ov {
  echo 'elese' ;
} else {
  echo 'else';
}

switch $c {
  case 'value':
    echo 'case';
    break;
  default:
    echo 'default';
}

foreach $av as $v {
  echo $v;
}
foreach $av as $k => $v {
  echo $k, $v;
}

for $i; $c; $s {
  echo 'for';
}

while $c {
  echo 'while';
}

do {
  echo 'do-while';
} while $c;
