<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport\Communication\Plugin;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use FondOfSpryker\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig;
use Spryker\Zed\DataImport\Dependency\Plugin\DataImportPluginInterface;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportFacadeInterface getFacade()
 */
class ShipmentTableRateDataImportPlugin extends AbstractPlugin implements DataImportPluginInterface
{
    /**
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null)
    {
        return $this->getFacade()->import($dataImporterConfigurationTransfer);
    }

    /**
     * @return string
     */
    public function getImportType()
    {
        return ShipmentTableRateDataImportConfig::IMPORT_TYPE_SHIPMENT_TABLE_RATE;
    }
}
