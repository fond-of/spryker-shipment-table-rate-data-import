<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport;

use Spryker\Zed\DataImport\DataImportConfig;

class ShipmentTableRateDataImportConfig extends DataImportConfig
{
    const IMPORT_TYPE_SHIPMENT_TABLE_RATE = 'shipment-table-rate';

    /**
     * @return \Generated\Shared\Transfer\DataImporterConfigurationTransfer
     */
    public function getShipmentTableRateDataImporterConfiguration()
    {
        return $this->buildImporterConfiguration( 'shipment_table_rate.csv', static::IMPORT_TYPE_SHIPMENT_TABLE_RATE);
    }

}