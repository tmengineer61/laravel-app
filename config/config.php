<?php
return [
  'RECRUIT_API_KEY' => env('RECRUIT_API_KEY'),
  'HOTPEPPER_API' => [
    'TIMEOUT' => 5,
    'RETRY' => [
      'TIMES' => 3,
      'WAIT' => 100
    ]
  ],
  'SHOP_CARDS' => [
    'OPEN' => [
      'MAX_LENGTH' => 20
    ]
  ],
  'PAGINATION' => [
    'ITEM_PER_PAGE' => 10,
  ]

];
