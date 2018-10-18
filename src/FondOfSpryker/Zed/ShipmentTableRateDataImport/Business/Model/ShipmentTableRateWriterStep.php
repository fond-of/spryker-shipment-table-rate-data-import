<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model;

use Exception;
use Orm\Zed\ShipmentTableRate\Persistence\FondOfSprykerShipmentTableRate;
use Orm\Zed\Category\Persistence\FondOfSprykerShipmentTableRateCategoryQuery;
use FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableRateReaderInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\AddLocalesStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\LocalizedAttributesExtractorStep;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ShipmentTableRateWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const KEY_NAME = 'name';
    const KEY_META_TITLE = 'meta_title';
    const KEY_META_DESCRIPTION = 'meta_description';
    const KEY_META_KEYWORDS = 'meta_keywords';
    const KEY_CATEGORY_KEY = 'category_key';
    const KEY_PARENT_CATEGORY_KEY = 'parent_category_key';
    const KEY_TEMPLATE_NAME = 'template_name';

    /**
     * @var \FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableReaderInterface
     */
    protected $shipmentTableRateReader;

    /**
     * @param \FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableRateReaderInterface $shipmentTableRateReader
     */
    public function __construct(ShipmentTableRateReaderInterface $shipmentTableRateReader)
    {
        $this->shipmentTableRateReader = $shipmentTableRateReader;
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $shipmentTableRateEntity = $this->findOrCreateShipmentTableRate($dataSet);

        $this->shipmentTableRateReader->addShipmentTableRate($shipmentTableRateEntity);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\Category\Persistence\SpyCategory
     */
    protected function findOrCreateShipmentTableRate(DataSetInterface $dataSet)
    {

    }
}
