<?php


namespace ConvToWin\Utility;

use Exception;


class ConvToWin
{
    /**
     * @var string
     */
    public $converted = '';

    /**
     * @var array
     */
    private $win = ['～', '∥', '－', '￠', '￡', '￢', '―'];

    /**
     * @var array
     */
    private $linux = ['〜', '‖', '−', '¢', '£', '¬', '—'];

    /**
     * @var string
     */
    private $input = '';

    /**
     * ConvToWin constructor.
     * @param $str
     * @throws Exception
     */
    public function __construct($str)
    {
        if (!is_scalar($str)) {
            throw new Exception('Cannot convert value to Win');
        }
        $this->input = $str;
    }

    /**
     *
     */
    public function convToWin()
    {
        $this->converted = '';
        $len = mb_strlen($this->input);
        for ($i = 0; $i < $len; $i++) {
            $input = mb_substr($this->input, $i, 1);
            $idx = array_search($input, $this->linux, true);
            if ($idx === false) {
                $this->converted .= $input;
            } else {
                $this->converted .= $this->win[$idx];
            }
        }
    }

}

