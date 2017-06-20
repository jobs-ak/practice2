<?php

namespace Magecian\Groupdeals\Block\Adminhtml;

class Newdeal extends \Magento\Backend\Block\Widget\Grid\Container
{
    /**
     * constructor
     *
     * @return void
     */
     protected function _construct()
      {
          $this->_controller = 'adminhtml_Deal_NewDeal';
          $this->_blockGroup = 'Magecien_Groupdeals';
          $this->_headerText = __('New Deals');
          $this->_addButtonLabel = __('Create New Deal');
          parent::_construct();
      }

     protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}
