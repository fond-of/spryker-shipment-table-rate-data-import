<?php

namespace FondOfSpryker\Zed\ShipmentTableRateDataImport\Business\Model;

use Exception;
use Orm\Zed\Country\Persistence\SpyCountryQuery;
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
    public const BULK_SIZE = 100;

    public const COL_COUNTRY = 'country';
    public const COL_STORE = 'store';
    public const COL_PRICE = 'price';
    public const COL_COST = 'cost';
    public const COL_ZIP_CODE = 'zip_code';

    public const KEY_FK_COUNTRY = 'fk_country';
    public const KEY_FK_STORE = 'fk_store';

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
        $this->findOrCreateShipmentTableRate($dataSet);
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
        $dataSet[static::COL_PRICE] = $dataSet[static::COL_PRICE] ?? 0;
        $dataSet[static::COL_COST] = $dataSet[static::COL_COST] ?? 0;

        $shipmentTableRateEntity = FosShipmentTableRateQuery::create()
            ->filterByFkCountry($dataSet[static::KEY_FK_COUNTRY])
            ->filterByFkStore($dataSet[static::KEY_FK_STORE])
            ->filterByZipCode($dataSet[static::COL_ZIP_CODE])
            ->filterByPrice($dataSet[static::COL_PRICE])
            ->filterByCost($dataSet[static::COL_COST])
            ->findOneOrCreate();

        $shipmentTableRateEntity->fromArray($dataSet->getArrayCopy());

        if ($shipmentTableRateEntity->isNew() || $shipmentTableRateEntity->isModified()) {
            try {
                $shipmentTableRateEntity->save();
            } catch (Exception $e) {
                print $e->getMessage();
                exit();
            }
        }

        return $shipmentTableRateEntity;
    }

    /**
     * @param string $countryIso2Code
     *
     * @return int
     */
    protected function getCountryIdByIso2Code(string $countryIso2Code): int
    {
        if (!isset(static::$countryIdsCache[$countryIso2Code])) {
            static::$countryIdsCache[$countryIso2Code] = SpyCountryQuery::create()
                ->findOneByIso2Code($countryIso2Code)
                ->getIdCountry();
        }

        return static::$countryIdsCache[$countryIso2Code];
    }

    /**
     * @param string $name
     *
     * @return int
     */
    protected function getStoreIdByName(string $name): int
    {
        if (!isset(static::$storeIdsCache[$name])) {
            static::$storeIdsCache[$name] = SpyStoreQuery::create()
                ->findOneByName($name)
                ->getIdStore();
        }

        return static::$storeIdsCache[$name];
    }
}
