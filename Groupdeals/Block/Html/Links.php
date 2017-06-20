<?php
namespace Magecian\Groupdeals\Block\Html;


class Links extends \Magento\Framework\View\Element\Html\Link
{


		protected function _toHtml()
       {
          if (false != $this->getTemplate()) {
           return parent::_toHtml();
        }
         return '<li><a ' . $this->getLinkAttributes() . ' >' . $this->escapeHtml($this->getLabel()) . '</a></li>';
    }
}