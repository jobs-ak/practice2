<?php
namespace Magecian\Groupdeals\Model\ResourceModel\Order;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magecian\Groupdeals\Model\Orderdetails', 'Magecian\Groupdeals\Model\ResourceModel\Order');
    }
}
