# Data Import for Table Rates Shipping
[![Build Status](https://travis-ci.org/fond-of/spryker-shipment-table-rate-data-import.svg?branch=master)](https://travis-ci.org/fond-of/spryker-shipment-table-rate-data-import)
[![PHP from Travis config](https://img.shields.io/travis/php-v/symfony/symfony.svg)](https://php.net/)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/fond-of-spryker/shipment-table-rate-data-import)


This extension makes it possible import the shipping table rates

## Installation

```
composer require fond-of-spryker/shipment-table-rate-data-import
```

## 1. Add Data Importer Plugin in  Pyz\Zed\DataImport\DataImportDependencyProvider

```
 /**
     * @return array
     */
    protected function getDataImporterPlugins(): array
    {
        return [
            [new ShipmentTableRateDataImportPlugin(), DataImportConfig::IMPORT_TYPE_SHIPMENT_TABLE_RATE]
            ........
        ];
    }
     
```

## 2. Add Import type constant in  Pyz\Zed\DataImport\DataImportConfig

```
 const IMPORT_TYPE_SHIPMENT_TABLE_RATE = 'shipment-table-rate';
     
```

## 3. Create data import file 

```
 shipment_table_rate.csv
 
 Example: 
 free_threshold,price,country,store,postcode
 100,2000,US,STORE_US,XXXXX    
 100,2500,US,STORE_US,X*    
```

