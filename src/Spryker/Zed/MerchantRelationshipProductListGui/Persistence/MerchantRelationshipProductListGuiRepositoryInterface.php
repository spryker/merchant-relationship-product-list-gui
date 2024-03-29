<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Persistence;

interface MerchantRelationshipProductListGuiRepositoryInterface
{
    /**
     * @var string
     */
    public const COL_MERCHANT_NAME_ALIAS = 'spy_merchant_name';

    /**
     * @var string
     */
    public const COL_BUSINESS_UNIT_OWNER_NAME_ALIAS = 'spy_company_business_unit_name';

    /**
     * @var string
     */
    public const COL_FK_MERCHANT_RELATIONSHIP = 'spy_product_list.fk_merchant_relationship';

    /**
     * @var string
     */
    public const COL_MERCHANT_NAME = 'spy_merchant.name';

    /**
     * @var string
     */
    public const COL_COMPANY_BUSINESS_UNIT_NAME = 'spy_company_business_unit.name';

    /**
     * @var string
     */
    public const COL_ID_MERCHANT_RELATIONSHIP = 'spy_merchant_relationship.id_merchant_relationship';

    /**
     * @var string
     */
    public const COL_FK_MERCHANT = 'spy_merchant_relationship.fk_merchant';

    /**
     * @var string
     */
    public const COL_ID_MERCHANT = 'spy_merchant.id_merchant';

    /**
     * @var string
     */
    public const COL_ID_COMPANY_BUSINESS_UNIT = 'spy_company_business_unit.id_company_business_unit';

    /**
     * @var string
     */
    public const COL_FK_COMPANY_BUSINESS_UNIT = 'spy_merchant_relationship.fk_company_business_unit';

    /**
     * @var string
     */
    public const LEFT_JOIN = 'LEFT JOIN';
}
