<?php

namespace Magecian\Groupdeals\Controller\Adminhtml\Deal;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Pendingdeals extends \Magento\Backend\App\Action
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
          $resultPage->setActiveMenu('Magecian_Groupdeals::pendingdeals');
          $resultPage->addBreadcrumb(__('Pending Deal'), __('Pending Deals'));
          $resultPage->getConfig()->getTitle()->prepend(__('Pending Deals'));
          return $resultPage;
      }
}

?>
