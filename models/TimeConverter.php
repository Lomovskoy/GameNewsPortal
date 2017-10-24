<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TimeConverter
 *
 * @author pupil
 */
class TimeConverter {
    //put your code here
    function second_v_date($sekund)
        {
            $dt = new DateTime('@' . $sekund);
            return array('days'    => $dt->format('z'),
                         'hours'   => $dt->format('G'),
                         'minutes' => $dt->format('i'),
                         'seconds' => $dt->format('s'));
        }
}
