<?php

namespace Zend\View\Model;

class CsvModel extends \Zend\View\Model\ViewModel
{
    protected $captureTo = null;
    protected $terminate = true;

    public function serialize() {
        $escape = function ($str) {
            if (is_int($str)) {
                return $str;
            }

            $res = str_replace(['"'], ['\"'], $str);

            if (preg_match('/\s/', $str)) {
                return '"'.$res.'"';
            }
            return $res;
        };

        // Quick build CSV
        $rows = [];
        foreach ($this->getVariables() as $i => $v) {
            if ($i == 0) {
                $rows[] = implode(',', array_map($escape, array_keys($v)));
            }

            $rows[] = implode(',', array_map($escape, array_values($v)));
        }

        return implode("\n", $rows);
    }
}
