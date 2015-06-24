<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Team
{
    public function __construct() {
        add_shortcode('test', array($this, 'teamHtml'));
    }
    
    public function teamHtml()
    {
        echo "A que coucou Bob !";
    }
}