<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport\Business;

use FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\ShipmentTableRateWriterStep;
use FondOfSpryker\ZedShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableRateReader;
use Spryker\Zed\DataImport\Business\DataImportBusinessFactory;

/**
 * @method \Spryker\Zed\CategoryDataImport\CategoryDataImportConfig getConfig()
 */
class ShipmentTableRateDataImportBusinessFactory extends DataImportBusinessFactory
{
    /**
     * @return \Spryker\Zed\DataImport\Business\Model\DataImporterInterface
     */
    public function createCategoryImporter()
    {
        $dataImporter = $this->getCsvDataImporterFromConfig($this->getConfig()->getShipmentTableRateDataImporterConfiguration());

        $dataSetStepBroker = $this->createTransactionAwareDataSetStepBroker();
        $dataSetStepBroker
            ->addStep($this->createAddLocalesStep())
            ->addStep($this->createLocalizedAttributesExtractorStep([
                ShipmenTableRateWriterStep::KEY_NAME,
                ShipmenTableRateWriterStep::KEY_META_TITLE,
                ShipmenTableRateWriterStep::KEY_META_DESCRIPTION,
                ShipmenTableRateWriterStep::KEY_META_KEYWORDS,
            ]))
            ->addStep(new ShipmenTableRateWriterStep($this->createShipmentTableRateRepository()));

        $dataImporter
            ->addDataSetStepBroker($dataSetStepBroker);

        return $dataImporter;
    }

    /**
     * @return \FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableRateReaderInterface
     */
    protected function createShipmentTableRepository()
    {
        return new ShipmentTableRateReader();
    }
}
