<?php

namespace FondOfSpryker\Zed\CategoryDataImport\Business\Model\Reader;

use Orm\Zed\ShipmentTableRate\Persistence\ShipmentTableRate;

interface ShipmentTableRateReaderInterface
{
    /**
     * @param \Orm\Zed\Category\Persistence\SpyCategory $categoryEntity
     * @param \Orm\Zed\Category\Persistence\SpyCategoryNode $categoryNodeEntity
     *
     * @return void
     */
    public function addShipmentTableRate(ShipmentTableRate $shipmentTableRate);

}
