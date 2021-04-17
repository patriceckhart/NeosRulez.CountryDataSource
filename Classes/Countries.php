<?php
namespace NeosRulez\CountryDataSource;

use Neos\Flow\Annotations as Flow;
use Symfony\Component\Yaml\Yaml;

/**
 * @Flow\Scope("singleton")
 */
class Countries {

    /**
     * @return array
     */
    function loadMetaData():array
    {
        $fileName = sprintf('resource://NeosRulez.CountryDataSource/Private/Metadata/countries.yml');
        return (array) Yaml::parseFile($fileName);
    }

}
