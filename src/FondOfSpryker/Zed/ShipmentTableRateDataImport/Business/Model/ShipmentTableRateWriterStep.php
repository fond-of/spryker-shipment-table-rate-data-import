<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model;

use Exception;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
use Orm\Zed\ShipmentTableRate\Persistence\FondOfSprykerShipmentTableRate;
use FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model\Reader\ShipmentTableRateReaderInterface;
use Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRateQuery;
use Orm\Zed\Store\Persistence\SpyStoreQuery;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\DataImportStepInterface;
use Spryker\Zed\DataImport\Business\Model\DataImportStep\PublishAwareStep;
use Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ShipmentTableRateWriterStep extends PublishAwareStep implements DataImportStepInterface
{
    const BULK_SIZE = 100;

    const COL_COUNTRY = 'country';
    const COL_STORE = 'store';

    const KEY_FK_COUNTRY = 'fk_country';
    const KEY_FK_STORE = 'fk_store';

    /**
     * @var int[] Keys are country iso2 codes, values are country ids.
     */
    protected static $countryIdsCache = [];

    /**
     * @var int[] Keys are store name, values are store ids.
     */
    protected static $storeIdsCache = [];

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return void
     */
    public function execute(DataSetInterface $dataSet)
    {
        $shipmentTableRateEntity = $this->findOrCreateShipmentTableRate($dataSet);
    }

    /**
     * @param \Spryker\Zed\DataImport\Business\Model\DataSet\DataSetInterface $dataSet
     *
     * @return \Orm\Zed\ShipmentTableRate\Persistence\FosShipmentTableRate
     */
    protected function findOrCreateShipmentTableRate(DataSetInterface $dataSet)
    {

        $dataSet[static::KEY_FK_COUNTRY] = $this->getCountryIdByIso2Code($dataSet[static::COL_COUNTRY]);
        $dataSet[static::KEY_FK_STORE] = $this->getStoreIdByName($dataSet[static::COL_STORE]);

        $shipmentTableRateEntity = FosShipmentTableRateQuery::create()
            ->filterByFkCountry($dataSet[static::KEY_FK_COUNTRY])
            ->filterByFkStore($dataSet[static::KEY_FK_STORE])
            ->findOneOrCreate();

        $shipmentTableRateEntity->fromArray($dataSet->getArrayCopy());

        if ($shipmentTableRateEntity->isNew() || $shipmentTableRateEntity->isModified()) {
            $shipmentTableRateEntity->save();
        }

        return $shipmentTableRateEntity;
    }

    /**
     * @param string $countryIso2Code
     *
     * @return int
     */
    protected function getCountryIdByIso2Code($countryIso2Code): int
    {
        if (!isset(static::$countryIdsCache[$countryIso2Code])) {
            static::$countryIdsCache[$countryIso2Code] = SpyCountryQuery::create()
                ->findOneByIso2Code($countryIso2Code)
                ->getIdCountry();
        }

        return static::$countryIdsCache[$countryIso2Code];
    }

    /**
     * @param string $countryIso2Code
     *
     * @return int
     */
    protected function getStoreIdByName($name): int
    {
        if (!isset(static::$storeIdsCache[$name])) {
            static::$storeIdsCache[$name] = SpyStoreQuery::create()
                ->findOneByName($name)
                ->getIdStore();
        }

        return static::$storeIdsCache[$name];
    }
}
