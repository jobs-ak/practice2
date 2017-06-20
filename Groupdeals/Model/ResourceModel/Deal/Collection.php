<?php
namespace Magecian\Groupdeals\Model\ResourceModel\Deal;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'deal_id';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Magecian\Groupdeals\Model\Deal', 'Magecian\Groupdeals\Model\ResourceModel\Deal');
    }
}
