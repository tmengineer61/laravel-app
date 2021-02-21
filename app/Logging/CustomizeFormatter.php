<?php

namespace App\Logging;

use Monolog\Formatter\LineFormatter;

class CustomizeFormatter extends LineFormatter
{
    const LOG_FORMAT = "%datetime% [%channel%.%level_name%] %message%" . PHP_EOL;
    const DATE_FORMAT = "Y-m-d H:i:s.v";

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        parent::__construct(self::LOG_FORMAT, self::DATE_FORMAT, true, true);
    }

    /**
     * ログをフォーマットする
     * 
     * @param array $record ログ定義情報配列
     * @return string $output ログ内容
     */
    public function format(array $record): string
    {
        $output = parent::format($record);

        return $output;
    }
}
?>