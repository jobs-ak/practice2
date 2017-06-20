<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

/**
 * Catalog manage products block
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
namespace Magecian\Groupdeals\Block\Adminhtml;

class Product extends  \Magento\Catalog\Block\Adminhtml\Product
{

    /**
     * Prepare button and grid
     *
     * @return \Magento\Catalog\Block\Adminhtml\Product
     */
    protected function _prepareLayout()
    {

        return parent::_prepareLayout();
        $this->buttonList->remove('add_new');


    }


}
