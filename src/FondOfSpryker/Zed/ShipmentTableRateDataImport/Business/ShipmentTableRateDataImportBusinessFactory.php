<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport\Business;

use FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableRateReader;
use FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\ShipmentTableRateWriterStep;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\ShipmentTableRateDataImport\ShipmentTableRateDataImportConfig getConfig()
 */
class ShipmentTableRateDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createShipmentTableRateImporter()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getShipmentTableRateDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker->addStep(new ShipmentTableRateWriterStep());
        $dataImporter->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }
}
