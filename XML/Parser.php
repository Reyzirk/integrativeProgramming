<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of Parser
 *
 * @author Choo Meng
 */
interface Parser {
    function getXML();
    function saveXML($fileName);
}
