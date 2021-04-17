<?php
namespace NeosRulez\CountryDataSource\Fusion;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;
use Neos\Fusion\FusionObjects\AbstractFusionObject;

class CountriesFusion extends AbstractFusionObject {

    /**
     * @Flow\Inject
     * @var \NeosRulez\CountryDataSource\Countries
     */
    protected $countries;


    /**
     * @return array
     */
    public function evaluate():array
    {
        $exclude = $this->fusionValue('exclude');
        $include = $this->fusionValue('include');
        $metadata = $this->countries->loadMetaData();
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
        return $result;
    }

}
