<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Business;

interface MerchantRelationshipProductListGuiFacadeInterface
{
    /**
     * @api
     *
     * @return \Generated\Shared\Transfer\MerchantRelationshipTransfer[]
     */
    public function listMerchantRelation(): array;
}
