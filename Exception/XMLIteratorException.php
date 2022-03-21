<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of XMLIteratorException
 *
 * @author Choo Meng
 */
class XMLIteratorException extends Exception{
    public function __construct($message) {
        $this->message = $message;
    }
}
