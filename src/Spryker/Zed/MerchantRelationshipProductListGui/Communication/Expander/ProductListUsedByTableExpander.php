<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Communication\Expander;

use Generated\Shared\Transfer\MerchantRelationshipConditionsTransfer;
use Generated\Shared\Transfer\MerchantRelationshipCriteriaTransfer;
use Generated\Shared\Transfer\ProductListTransfer;
use Generated\Shared\Transfer\ProductListUsedByTableRowTransfer;
use Generated\Shared\Transfer\ProductListUsedByTableTransfer;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper\ProductListUsedByTableMapperInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipFacadeInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface;

class ProductListUsedByTableExpander implements ProductListUsedByTableExpanderInterface
{
    /**
     * @var \Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipFacadeInterface
     */
    protected $merchantRelationshipFacade;

    /**
     * @var \Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface
     */
    protected $merchantRelationshipProductListFacade;

    /**
     * @var \Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper\ProductListUsedByTableMapperInterface
     */
    protected $productListUsedByTableMapper;

    /**
     * @param \Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipFacadeInterface $merchantRelationshipFacade
     * @param \Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface $merchantRelationshipProductListFacade
     * @param \Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper\ProductListUsedByTableMapperInterface $productListUsedByTableMapper
     */
    public function __construct(
        MerchantRelationshipProductListGuiToMerchantRelationshipFacadeInterface $merchantRelationshipFacade,
        MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface $merchantRelationshipProductListFacade,
        ProductListUsedByTableMapperInterface $productListUsedByTableMapper
    ) {
        $this->merchantRelationshipFacade = $merchantRelationshipFacade;
        $this->productListUsedByTableMapper = $productListUsedByTableMapper;
        $this->merchantRelationshipProductListFacade = $merchantRelationshipProductListFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListUsedByTableTransfer $productListUsedByTableTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListUsedByTableTransfer
     */
    public function expandTableData(ProductListUsedByTableTransfer $productListUsedByTableTransfer): ProductListUsedByTableTransfer
    {
        $productListUsedByTableTransfer->getProductList()->requireIdProductList();

        $merchantRelationshipTransfers = $this->getMerchantRelationshipTransfers($productListUsedByTableTransfer->getProductList());

        $productListUsedByTableTransfer = $this->expandProductListUsedByTableTransfer(
            $productListUsedByTableTransfer,
            $merchantRelationshipTransfers,
        );

        return $productListUsedByTableTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListTransfer $productListTransfer
     *
     * @return array<\Generated\Shared\Transfer\MerchantRelationshipTransfer>
     */
    protected function getMerchantRelationshipTransfers(ProductListTransfer $productListTransfer): array
    {
        $merchantRelationshipIds = $this->merchantRelationshipProductListFacade
            ->getMerchantRelationshipIdsByProductListId($productListTransfer->getIdProductList());

        if (!$merchantRelationshipIds) {
            return [];
        }

        $merchantRelationshipCriteriaTransfer = (new MerchantRelationshipCriteriaTransfer())
            ->setMerchantRelationshipConditions(
                (new MerchantRelationshipConditionsTransfer())
                    ->setMerchantRelationshipIds($merchantRelationshipIds),
            );

        /** @var \Generated\Shared\Transfer\MerchantRelationshipCollectionTransfer $merchantRelationshipCollectionTransfer */
        $merchantRelationshipCollectionTransfer = $this->merchantRelationshipFacade
            ->getMerchantRelationshipCollection(null, $merchantRelationshipCriteriaTransfer);

        return $merchantRelationshipCollectionTransfer->getMerchantRelationships()->getArrayCopy();
    }

    /**
     * @param \Generated\Shared\Transfer\ProductListUsedByTableTransfer $productListUsedByTableTransfer
     * @param array<\Generated\Shared\Transfer\MerchantRelationshipTransfer> $merchantRelationshipTransfers
     *
     * @return \Generated\Shared\Transfer\ProductListUsedByTableTransfer
     */
    protected function expandProductListUsedByTableTransfer(
        ProductListUsedByTableTransfer $productListUsedByTableTransfer,
        array $merchantRelationshipTransfers
    ): ProductListUsedByTableTransfer {
        foreach ($merchantRelationshipTransfers as $merchantRelationshipTransfer) {
            $productListUsedByTableTransfer->addRow(
                $this->productListUsedByTableMapper->mapMerchantRelationshipTransferToProductListUsedByTableRowTransfer(
                    $merchantRelationshipTransfer,
                    new ProductListUsedByTableRowTransfer(),
                ),
            );
        }

        return $productListUsedByTableTransfer;
    }
}
