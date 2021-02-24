<?php
return [
  'RECRUIT_API_KEY' => env('RECRUIT_API_KEY'),
  'HOTPEPPER_API' => [
    'TIMEOUT' => 5,
    'RETRY' => [
      'TIMES' => 3,
      'WAIT' => 100
    ]
  ]
];
