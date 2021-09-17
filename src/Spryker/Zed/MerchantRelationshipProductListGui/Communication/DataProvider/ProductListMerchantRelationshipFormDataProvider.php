<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Communication\DataProvider;

use Generated\Shared\Transfer\MerchantRelationshipTransfer;
use Generated\Shared\Transfer\ProductListCollectionTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\FormExpander\ProductListMerchantRelationshipFormExpander;
use Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface;

class ProductListMerchantRelationshipFormDataProvider
{
    /**
     * @var \Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface
     */
    protected $merchantRelationshipProductListFacade;

    /**
     * @param \Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface $merchantRelationshipProductListFacade
     */
    public function __construct(
        MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface $merchantRelationshipProductListFacade
    ) {
        $this->merchantRelationshipProductListFacade = $merchantRelationshipProductListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationshipTransfer|null $merchantRelationshipTransfer
     *
     * @return array
     */
    public function getOptions(?MerchantRelationshipTransfer $merchantRelationshipTransfer): array
    {
        $productListCollectionTransfer = $this->merchantRelationshipProductListFacade
            ->getAvailableProductListsForMerchantRelationship($merchantRelationshipTransfer ?: new MerchantRelationshipTransfer());

        return [
            ProductListMerchantRelationshipFormExpander::OPTION_PRODUCT_LIST_CHOICES => $this->getProductListChoices($productListCollectionTransfer),
            ProductListMerchantRelationshipFormExpander::OPTION_DATA => $this->getAssignedProductListIds($productListCollectionTransfer, $merchantRelationshipTransfer),
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     *
     * @return array<int>
     */
    protected function getProductListChoices(ProductListCollectionTransfer $productListCollectionTransfer): array
    {
        $productListChoices = [];

        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            $productListChoices[$this->generateProductListChoiceLabel($productListTransfer)] = $productListTransfer->getIdProductList();
        }

        return $productListChoices;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListCollectionTransfer $productListCollectionTransfer
     * @param \Generated\Shared\Transfer\MerchantRelationshipTransfer|null $merchantRelationshipTransfer
     *
     * @return array<int>
     */
    protected function getAssignedProductListIds(
        ProductListCollectionTransfer $productListCollectionTransfer,
        ?MerchantRelationshipTransfer $merchantRelationshipTransfer
    ): array {
        if (!$merchantRelationshipTransfer) {
            return [];
        }

        $assignedProductListIds = [];

        foreach ($productListCollectionTransfer->getProductLists() as $productListTransfer) {
            if ($productListTransfer->getFkMerchantRelationship() === $merchantRelationshipTransfer->getIdMerchantRelationship()) {
                $assignedProductListIds[] = $productListTransfer->getIdProductList();
            }
        }

        return $assignedProductListIds;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return string
     */
    protected function generateProductListChoiceLabel(ProductListTransfer $productListTransfer): string
    {
        return sprintf('%s (%s)', $productListTransfer->getTitle(), $productListTransfer->getType());
    }
}
