<?php

namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Activedeals extends \Magento\Backend\App\Action
{

      protected $resultPageFactory;

      public function __construct(
          Context $context,
          PageFactory $resultPageFactory
      ) {
          parent::__construct($context);
          $this->resultPageFactory = $resultPageFactory;
      }


      public function execute()
      {
          /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
          $resultPage = $this->resultPageFactory->create();
          $resultPage->setActiveMenu('Magecian_Groupdeals::activedeals');
          $resultPage->addBreadcrumb(__('New Deal'), __('Active Deals'));
          $resultPage->getConfig()->getTitle()->prepend(__('Active Deals'));
          return $resultPage;
      }
}

?>
