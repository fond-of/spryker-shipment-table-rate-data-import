<?php

namespace Spryker\Zed\ShipmenTableRateDataImport\Business;

use Generated\Shared\Transfer\DataImporterConfigurationTransfer;
use Generated\Shared\Transfer\DataImporterReportTransfer;
use Spryker\Zed\Kernel\Business\AbstractFacade;

/**
 * @api
 *
 * @method \FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\ShipmentTableRateDataImportBusinessFactory getFactory()
 */
class ShipmentTableRateDataImportFacade extends AbstractFacade implements ShipmentTableRateDataImportFacadeInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\DataImporterConfigurationTransfer|null $dataImporterConfigurationTransfer
     *
     * @return \Generated\Shared\Transfer\DataImporterReportTransfer
     */
    public function import(?DataImporterConfigurationTransfer $dataImporterConfigurationTransfer = null): DataImporterReportTransfer
    {
        return $this->getFactory()->createShipmentTableRateImporter()->import($dataImporterConfigurationTransfer);
    }
}
