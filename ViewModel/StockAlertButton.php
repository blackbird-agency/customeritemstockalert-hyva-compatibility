<?php
/**
 * Blackbird Customer Item Stock Alert Hyvä Compatibility
 *
 * @copyright Copyright (c) 2026 Blackbird Agency (https://black.bird.eu)
 * @license   MIT, see LICENSE.txt
 */

declare(strict_types=1);

namespace Blackbird\CustomerItemStockAlertHyvaCompatibility\ViewModel;

use Blackbird\CustomerItemStockAlert\ViewModel\CisaViewModel;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Catalog\Model\Product;
use Magento\Framework\View\Element\Block\ArgumentInterface;

/**
 * Which alert button the product page shows: shared by the button and by the modal, rendered only with the button
 */
class StockAlertButton implements ArgumentInterface
{
    /** Out of stock product: one button for the product itself */
    public const MODE_PRODUCT = 'product';

    /** Saleable configurable product with out of stock children */
    public const MODE_CHILDREN = 'children';

    private const PRODUCT_TYPES = ['simple', 'virtual', 'configurable'];

    /**
     * @var CisaViewModel
     */
    private CisaViewModel $cisaViewModel;

    /**
     * @var array<int|string, string>
     */
    private array $modes = [];

    /**
     * @param CisaViewModel $cisaViewModel
     */
    public function __construct(CisaViewModel $cisaViewModel)
    {
        $this->cisaViewModel = $cisaViewModel;
    }

    /**
     * Same rules as Blackbird_CustomerItemStockAlert::button.phtml; empty string when no button is shown
     *
     * @param ProductInterface|null $product
     * @return string
     */
    public function getMode(?ProductInterface $product): string
    {
        if (!$product instanceof Product) {
            return '';
        }
        $key = $product->getId();
        if (!isset($this->modes[$key])) {
            $this->modes[$key] = $this->computeMode($product);
        }

        return $this->modes[$key];
    }

    /**
     * Compute the button mode
     *
     * @param Product $product
     * @return string
     */
    private function computeMode(Product $product): string
    {
        if (!$product->isSaleable()) {
            return \in_array($product->getTypeId(), self::PRODUCT_TYPES, true) ? self::MODE_PRODUCT : '';
        }
        $children = $this->cisaViewModel->getOutOfStockChildren($product);

        return empty($children['listingOOS']) ? '' : self::MODE_CHILDREN;
    }
}
