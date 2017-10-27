<?php

class TimeConverter {
    
    /**
     * 
     * @param type $datetime
     * @param type $i
     * @return type
     * Этот метод отдаёт разницу во времени.
     * Если аргумент не передан отдаёт полный формат г,м,н,д,мин,ч
     * Если передано число отдаёт колчисество параметров = числу
     */
    public static function time_elapsed_string($datetime, $i = 0)
    {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;
        $string = array(
                'y' => 'г.',
                'm' => 'мес.',
                'w' => 'нед.',
                'd' => 'д.',
                'h' => 'ч.',
                'i' => 'м.',
                's' => 'с.',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
            } else {
                unset($string[$k]);
            }
        }
        if ($i != 0) $string = array_slice($string, 0, $i);
        return $string ? implode(', ', $string) . ' назад' : 'сейчас';
    }
}
