<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\MerchantRelationshipProductListGui\Communication;

use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\DataProvider\MerchantRelationshipChoiceFormDataProvider;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\DataProvider\ProductListMerchantRelationshipFormDataProvider;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Expander\ProductListButtonsExpander;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Expander\ProductListButtonsExpanderInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Expander\ProductListUsedByTableExpander;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Expander\ProductListUsedByTableExpanderInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Form\MerchantRelationshipChoiceFormType;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\FormExpander\ProductListMerchantRelationshipFormExpander;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\FormExpander\ProductListMerchantRelationshipFormExpanderInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper\ProductListUsedByTableMapper;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\Mapper\ProductListUsedByTableMapperInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\ProductListQueryExpander\ProductListQueryExpander;
use Spryker\Zed\MerchantRelationshipProductListGui\Communication\ProductListQueryExpander\ProductListQueryExpanderInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipFacadeInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\Dependency\Facade\MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface;
use Spryker\Zed\MerchantRelationshipProductListGui\MerchantRelationshipProductListGuiDependencyProvider;

/**
 * @method \Spryker\Zed\MerchantRelationshipProductListGui\MerchantRelationshipProductListGuiConfig getConfig()
 * @method \Spryker\Zed\MerchantRelationshipProductListGui\Persistence\MerchantRelationshipProductListGuiRepositoryInterface getRepository()
 */
class MerchantRelationshipProductListGuiCommunicationFactory extends AbstractCommunicationFactory
{
    public function createMerchantRelationshipChoiceFormDataProvider(): MerchantRelationshipChoiceFormDataProvider
    {
        return new MerchantRelationshipChoiceFormDataProvider($this->getMerchantRelationshipFacade());
    }

    public function createMerchantRelationshipChoiceFormType(): MerchantRelationshipChoiceFormType
    {
        return new MerchantRelationshipChoiceFormType();
    }

    public function createProductListButtonsExpander(): ProductListButtonsExpanderInterface
    {
        return new ProductListButtonsExpander();
    }

    public function createProductListUsedByTableExpander(): ProductListUsedByTableExpanderInterface
    {
        return new ProductListUsedByTableExpander(
            $this->getMerchantRelationshipFacade(),
            $this->getMerchantRelationshipProductListFacade(),
            $this->createProductListUsedByTableMapper(),
        );
    }

    public function createProductListUsedByTableMapper(): ProductListUsedByTableMapperInterface
    {
        return new ProductListUsedByTableMapper();
    }

    public function getMerchantRelationshipFacade(): MerchantRelationshipProductListGuiToMerchantRelationshipFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationshipProductListGuiDependencyProvider::FACADE_MERCHANT_RELATIONSHIP);
    }

    public function getMerchantRelationshipProductListFacade(): MerchantRelationshipProductListGuiToMerchantRelationshipProductListFacadeInterface
    {
        return $this->getProvidedDependency(MerchantRelationshipProductListGuiDependencyProvider::FACADE_MERCHANT_RELATIONSHIP_PRODUCT_LIST);
    }

    public function createProductListQueryExpander(): ProductListQueryExpanderInterface
    {
        return new ProductListQueryExpander();
    }

    public function createProductListMerchantRelationshipFormExpander(): ProductListMerchantRelationshipFormExpanderInterface
    {
        return new ProductListMerchantRelationshipFormExpander(
            $this->createProductListMerchantRelationshipFormDataProvider(),
        );
    }

    public function createProductListMerchantRelationshipFormDataProvider(): ProductListMerchantRelationshipFormDataProvider
    {
        return new ProductListMerchantRelationshipFormDataProvider(
            $this->getMerchantRelationshipProductListFacade(),
        );
    }
}
