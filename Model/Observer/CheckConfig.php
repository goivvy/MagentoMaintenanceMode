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

namespace Goivvyllc\MaintenanceMode\Model\Observer;

use Goivvyllc\MaintenanceMode\Model\Config;
use Magento\Framework\App\MaintenanceMode;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Message\ManagerInterface;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;

class CheckConfig implements ObserverInterface
{
    protected $_config;
     
    protected $_messageManager;     
     
    protected $_maintenanceMode;
    
    protected $_remoteAddress;
     
    public function __construct(Config $_config
                              , ManagerInterface $_messageManager
                              , MaintenanceMode $_maintenanceMode
                              , RemoteAddress $_remoteAddress)
    {
       $this->_config = $_config;
       $this->_messageManager = $_messageManager;
       $this->_maintenanceMode= $_maintenanceMode;
       $this->_remoteAddress = $_remoteAddress;
    }
     
    public function execute(Observer $observer) 
    {
      if($this->_config->isGmodeOn()){
        $this->_maintenanceMode->set(true);
        $this->_maintenanceMode->setAddresses($this->_remoteAddress->getRemoteAddress());
        $this->_messageManager->addSuccessMessage(__('Maintenance Mode has been turned on. Your site is on maintenance and no sales will go through. Your IP has been whitelisted so that you could access both frontend and backend.'));   
      }else{
        $this->_maintenanceMode->set(false);
        $this->_maintenanceMode->setAddresses('');
        $this->_messageManager->addSuccessMessage(__('Maintenance mode has been turned off. Your site is live.'));   
      }
    }
}
