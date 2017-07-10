<?php
/**

 */
namespace Magecian\Groupdeals\Ui\Component\Listing\Columns;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;


class OrderdetailsActions extends Column
{

    const URL_PATH_EDIT = 'magecian_groupdeals/deal/edit';
  /**
   * @var UrlInterface
   */
  protected $urlBuilder;

  /**
   * @param ContextInterface $context
   * @param UiComponentFactory $uiComponentFactory
   * @param UrlInterface $urlBuilder
   * @param array $components
   * @param array $data
   */
  public function __construct(
      ContextInterface $context,
      UiComponentFactory $uiComponentFactory,
      UrlInterface $urlBuilder,
      array $components = [],
      array $data = []
  ) {
      $this->urlBuilder = $urlBuilder;
      parent::__construct($context, $uiComponentFactory, $components, $data);
  }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
      if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                if (isset($item['status'])) {
                    $item[$this->getData('id')] = [
                        'select' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_PATH_EDIT,
                                [
                                  
                                    'id' => $item['id'],
                                    'deal_id' => $item['deal_id']

                                ]
                               
                            ),
                            'label' => __('Select')
                        ]
                    ];
                }
            }
        }
        return $dataSource;

    }
}
