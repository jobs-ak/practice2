<?php

namespace Magecian\Groupdeals\Model\Deal;

class Image
{
    /**
     * Media sub folder
     *
     * @var string
     */
    public $subDir = 'magecian/groupdeals/deal';

    /**
     * URL builder
     *
     * @var \Magento\Framework\UrlInterface
     */
	public $urlBuilder;

    /**
     * File system model
     *
     * @var \Magento\Framework\Filesystem
     */
	public $fileSystem;

    /**
     * constructor
     *
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\Filesystem $fileSystem
     */
    public function __construct(
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\Filesystem $fileSystem
    ) {
    
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
    }

    /**
     * get images base url
     *
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->urlBuilder->getBaseUrl(['_type' => \Magento\Framework\UrlInterface::URL_TYPE_MEDIA])
			.$this->subDir.'/image';
    }
    /**
     * get base image dir
     *
     * @return string
     */
    public function getBaseDir()
    {
        return $this->fileSystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA)
			->getAbsolutePath($this->subDir.'/image');
    }
}
