<?php
/**
 * Blackbird Customer Item Stock Alert Hyvä Compatibility
 *
 * @copyright Copyright (c) 2026 Blackbird Agency (https://black.bird.eu)
 * @license   MIT, see LICENSE.txt
 */

declare(strict_types=1);

namespace Blackbird\CustomerItemStockAlertHyvaCompatibility\ViewModel;

use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\Product;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Display helpers of the "My Product Alerts" customer page
 */
class AlertDisplay implements ArgumentInterface
{
    /**
     * @var PriceCurrencyInterface
     */
    private PriceCurrencyInterface $priceCurrency;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;

    /**
     * @var Image
     */
    private Image $imageHelper;

    /**
     * @param PriceCurrencyInterface $priceCurrency
     * @param StoreManagerInterface $storeManager
     * @param Image $imageHelper
     */
    public function __construct(
        PriceCurrencyInterface $priceCurrency,
        StoreManagerInterface $storeManager,
        Image $imageHelper
    ) {
        $this->priceCurrency = $priceCurrency;
        $this->storeManager = $storeManager;
        $this->imageHelper = $imageHelper;
    }

    /**
     * Small image URL, same image and size as the Luma page
     *
     * @param Product $product
     * @return string
     */
    public function getImageUrl(Product $product): string
    {
        return $this->imageHelper->init($product, 'product_page_image_small')
            ->setImageFile($product->getSmallImage())
            ->resize(150)
            ->getUrl();
    }

    /**
     * Price in the current store currency, empty when the product has no price
     *
     * @param float|string|null $price
     * @return string
     */
    public function formatPrice(float|string|null $price): string
    {
        if ($price === '' || !\is_numeric($price)) {
            return '';
        }

        return $this->priceCurrency->convertAndFormat((float) $price, false);
    }

    /**
     * Store name instead of its id; the id when the store no longer exists
     *
     * @param int|string $storeId
     * @return string
     */
    public function getStoreName(int|string $storeId): string
    {
        try {
            return (string) $this->storeManager->getStore((int) $storeId)->getName();
        } catch (NoSuchEntityException $e) {
            return (string) $storeId;
        }
    }
}
