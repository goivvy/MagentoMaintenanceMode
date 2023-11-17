<?php
/**
 * This source file is subject to the Open Software License (OSL 3.0)
 * It is available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to sales@goivvy.com so we can send you a copy immediately.
 *
 * @component  Goivvyllc_MaintenanceMode
 * @copyright  Copyright (c) 2023 GOIVVY LLC (https://www.goivvy.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Goivvy.com <sales@goivvy.com>
 */

namespace Goivvyllc\MaintenanceMode\Model;

use \Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    protected $_scopeConfig;
     
    public function __construct(ScopeConfigInterface $scopeConfig){
       $this->_scopeConfig = $scopeConfig; 
    }
     
    public function isGmodeOn()
    {
       return $this->_scopeConfig->isSetFlag('goivvymode/general/enable'); 
    }
}
