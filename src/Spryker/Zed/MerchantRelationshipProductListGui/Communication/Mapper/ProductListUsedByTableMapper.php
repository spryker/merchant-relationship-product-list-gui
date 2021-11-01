<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper;

use Generated\Shared\Transfer\ButtonCollectionTransfer;
use Generated\Shared\Transfer\ButtonTransfer;
use Generated\Shared\Transfer\MerchantRelationshipTransfer;
use Generated\Shared\Transfer\ProductListUsedByTableRowTransfer;
use Spryker\Service\UtilText\Model\Url\Url;

class ProductListUsedByTableMapper implements ProductListUsedByTableMapperInterface
{
    /**
     * @var string
     */
    protected const ENTITY_TITLE = 'Merchant Relationship';

    /**
     * @var string
     */
    protected const EDIT_BUTTON_TITLE = 'Edit Merchant Relationship';

    /**
     * @var array<string, string>
     */
    protected const EDIT_BUTTON_OPTIONS = [
        'class' => 'btn-edit btn-xs',
        'iconClass' => 'fa fa-pencil-square-o',
    ];

    /**
     * @uses \Spryker\Zed\MerchantRelationshipGui\Communication\Controller\EditMerchantRelationshipController::indexAction()
     *
     * @var string
     */
    protected const ROUTE_EDIT_MERCHANT_RELATIONSHIP = '/merchant-relationship-gui/edit-merchant-relationship';

    /**
     * @var string
     */
    protected const PARAM_ID_MERCHANT_RELATIONSHIP = 'id-merchant-relationship';

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationshipTransfer $merchantRelationshipTransfer
     * @param \Generated\Shared\Transfer\ProductListUsedByTableRowTransfer $productListUsedByTableRowTransfer
     *
     * @return \Generated\Shared\Transfer\ProductListUsedByTableRowTransfer
     */
    public function mapMerchantRelationshipTransferToProductListUsedByTableRowTransfer(
        MerchantRelationshipTransfer $merchantRelationshipTransfer,
        ProductListUsedByTableRowTransfer $productListUsedByTableRowTransfer
    ): ProductListUsedByTableRowTransfer {
        $merchantRelationshipTransfer->requireName()->requireIdMerchantRelationship();

        $productListUsedByTableRowTransfer->setTitle(static::ENTITY_TITLE)
            ->setName($merchantRelationshipTransfer->getName())
            ->setActionButtons($this->createActionButtons($merchantRelationshipTransfer));

        return $productListUsedByTableRowTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\MerchantRelationshipTransfer $merchantRelationshipTransfer
     *
     * @return \Generated\Shared\Transfer\ButtonCollectionTransfer
     */
    protected function createActionButtons(MerchantRelationshipTransfer $merchantRelationshipTransfer): ButtonCollectionTransfer
    {
        $buttonCollectionTransfer = new ButtonCollectionTransfer();

        $buttonCollectionTransfer = $this->addEditButton($buttonCollectionTransfer, $merchantRelationshipTransfer);

        return $buttonCollectionTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\ButtonCollectionTransfer $buttonCollectionTransfer
     * @param \Generated\Shared\Transfer\MerchantRelationshipTransfer $merchantRelationshipTransfer
     *
     * @return \Generated\Shared\Transfer\ButtonCollectionTransfer
     */
    protected function addEditButton(
        ButtonCollectionTransfer $buttonCollectionTransfer,
        MerchantRelationshipTransfer $merchantRelationshipTransfer
    ): ButtonCollectionTransfer {
        $url = Url::generate(static::ROUTE_EDIT_MERCHANT_RELATIONSHIP, [
            static::PARAM_ID_MERCHANT_RELATIONSHIP => $merchantRelationshipTransfer->getIdMerchantRelationship(),
        ])->build();

        $buttonTransfer = (new ButtonTransfer())
            ->setUrl($url)
            ->setTitle(static::EDIT_BUTTON_TITLE)
            ->setDefaultOptions(static::EDIT_BUTTON_OPTIONS);

        return $buttonCollectionTransfer->addButton($buttonTransfer);
    }
}
