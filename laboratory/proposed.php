<?php

//
// NOT IMPLEMENTED
//

for $var in $list {
head
  echo 'Initializing iteration';
first
  echo 'This is the start of first iteration';
  ...
  echo 'This is the end of first iteration';
body
  echo 'This is the start of typical iteration';
  first echo 'This is the first iteration';
  inside echo 'This is any but the first or last iteration';
  last echo 'This is the last iteration';
  echo list[key];
  first echo 'This is the first iteration';
  inside echo 'This is any but the first or last iteration';
  last echo 'This is the last iteration';
  echo 'This is the end of typical iteration';
last
  echo 'This is the start of last iteration';
  ...
  echo 'This is the end of last iteration';
tail
  echo 'Finilizing iteration';
empty
  echo 'Nothing to iterate, collection is [].';
null
  echo 'Nothing to iterate, collection is null';
empty, null
  echo 'Nothing to iterate, collection is [] or null';
undef
  echo 'Nothing to iterate, collection is undefined';
error
  echo 'Error, collection is not itterable';
}

for $var in $list before {
  echo 'Initializing iteration';
} {
  echo list[key];
} after {
  echo 'Finilizing iteration'
}
else {
  echo 'Nothing to iterate, collection is empty.';
}

foreach ($this->clients as $client) if ($from !== $client) {
      $client->send($msg);
      echo $client->resourceId, ' ';
    }

$a = filter $orders => $order['key'];

for $var in $list { // python
  echo list[key] ;
}

for $key of $list {
  echo list[key] ;
}

foreach $as {
  echo $a;
}

for $orders {
  $order = 1;
}

for $orders[$order] {
  $order = 1;
}

for $part|s {
  $part = 1;
}

for $orders[$key => $order] {
  $order = 1;
}


for $key => $var in $list {
  echo list[key] ;
}


forkey $key in $list {
  echo list[key] ;
}

//
// IMPLEMENTED
//

for $v in $array {
  echo $v;
}

for $array as $v {
  echo $v;
}

if $v {
  echo 'if';
} elseif $ov {
  echo 'elese';
} else {
  echo 'else';
}

switch $c {
  case 'value':
    echo 'case';
    break;
  case default:
    echo 'default';
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
