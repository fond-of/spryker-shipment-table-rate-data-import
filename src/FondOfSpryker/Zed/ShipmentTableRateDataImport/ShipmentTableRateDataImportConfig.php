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
        $moduleDataImportDirectory = $this->getModuleRoot() . 'data' . DIRECTORY_SEPARATOR . 'import' . DIRECTORY_SEPARATOR;

        return $this->buildImporterConfiguration($moduleDataImportDirectory . 'shipment_table_rate.csv', static::IMPORT_TYPE_SHIPMENT_TABLE_RATE);
    }

    /**
     * @return string
     */
    protected function getModuleRoot(): string
    {
        $moduleRoot = realpath(
            __DIR__
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
            . DIRECTORY_SEPARATOR . '..'
        );

        return $moduleRoot . DIRECTORY_SEPARATOR;
    }
}
