<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper;

use Generated\Shared\Transfer\MerchantRelationshipTransfer;
use Generated\Shared\Transfer\ProductListUsedByTableRowTransfer;

interface ProductListUsedByTableMapperInterface
{
    /**
     * @param \Generated\Shared\Transfer\MerchantRelationshipTransfer $merchantRelationshipTransfer
     * @param \Generated\Shared\Transfer\ProductListUsedByTableRowTransfer $productListUsedByTableRowTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListUsedByTableRowTransfer
     */
    public function mapMerchantRelationshipTransferToProductListUsedByTableRowTransfer(
        MerchantRelationshipTransfer $merchantRelationshipTransfer,
        ProductListUsedByTableRowTransfer $productListUsedByTableRowTransfer
    ): ProductListUsedByTableRowTransfer;
}
