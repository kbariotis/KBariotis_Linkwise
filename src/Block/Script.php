<?php

/**
 * @package    KBariotis_Linkwise
 * @author     Kostas Bariotis
 * @copyright  Copyright (c) 2014 Kostas Bariotis (http://www.kostasbariotis.com)
 * @licence  https://github.com/stakisko/KBariotis_Linkwise/blob/master/LICENCE MIT
 */

class KBariotis_Linkwise_Block_Script extends Mage_Core_Block_Template
{
    public function isEnabled() {
        return Mage::getStoreConfig('linkwise/general/enabled');
    }
}