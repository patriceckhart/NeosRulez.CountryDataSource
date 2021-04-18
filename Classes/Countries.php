<?php
namespace NeosRulez\CountryDataSource;

use Neos\Flow\Annotations as Flow;
use Symfony\Component\Yaml\Yaml;

/**
 * @Flow\Scope("singleton")
 */
class Countries {

    /**
     * @param string $exclude
     * @param string $include
     * @param string $independent
     * @param string $unMember
     * @return array
     */
    function getCountries(string $exclude, string $include, string $independent, string $unMember):array
    {
        $metadata = $this->loadMetaData();
        $result = $metadata;
        if($exclude) {
            $exclusions = explode(',', $exclude);
            $result = [];
            foreach ($metadata as $country) {
                if(!in_array($country['cca2'], array_values($exclusions))) {
                    $result[] = $country;
                }
            }
        }
        if($include) {
            $inclusions = explode(',', $include);
            $result = [];
            foreach ($metadata as $country) {
                if(in_array($country['cca2'], array_values($inclusions))) {
                    $result[] = $country;
                }
            }
        }
        if($independent || $unMember) {
            $filteredResult = [];
            foreach ($result as $country) {
                if($independent == 'true' && $unMember == 'true') {
                    if($country['independent'] == true && $country['unMember'] == true) {
                        $filteredResult[] = $country;
                    }
                }
                if($independent == 'false' && $unMember == 'false') {
                    if($country['independent'] == false && $country['unMember'] == false) {
                        $filteredResult[] = $country;
                    }
                }
                if($independent == 'true' && $unMember == 'false') {
                    if($country['independent'] == true && !$country['unMember'] == true) {
                        $filteredResult[] = $country;
                    }
                }
                if($independent == 'false' && $unMember == 'true') {
                    if(!$country['independent'] == true && $country['unMember'] == true) {
                        $filteredResult[] = $country;
                    }
                }
                if($independent == 'true' && !$unMember) {
                    if($country['independent'] == true) {
                        $filteredResult[] = $country;
                    }
                }
                if(!$independent && $unMember == 'true') {
                    if($country['unMember'] == true) {
                        $filteredResult[] = $country;
                    }
                }
                if($independent == 'false' && !$unMember) {
                    if(!$country['independent'] == true) {
                        $filteredResult[] = $country;
                    }
                }
                if(!$independent && $unMember == 'false') {
                    if(!$country['unMember'] == true) {
                        $filteredResult[] = $country;
                    }
                }
            }
            $result = $filteredResult;
        }
        return $result;
    }

    /**
     * @return array
     */
    function loadMetaData():array
    {
        $fileName = sprintf('resource://NeosRulez.CountryDataSource/Private/Metadata/countries.yml');
        return (array) Yaml::parseFile($fileName);
    }

}
