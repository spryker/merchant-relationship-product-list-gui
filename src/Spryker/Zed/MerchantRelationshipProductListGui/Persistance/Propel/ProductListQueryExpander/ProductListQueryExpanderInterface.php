<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Persistance\Propel\ProductListQueryExpander;

use Generated\Shared\Transfer\PriceProductCriteriaTransfer;
use Generated\Shared\Transfer\QueryCriteriaTransfer;

interface ProductListQueryExpanderInterface
{
    /**
     * @return \Generated\Shared\Transfer\QueryCriteriaTransfer
     */
    public function buildProductListMerchantQueryCriteria(): QueryCriteriaTransfer;
}