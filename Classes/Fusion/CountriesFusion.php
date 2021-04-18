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
        $independent = $this->fusionValue('independent');
        $unMember = $this->fusionValue('unMember');
        $result = [];
        $countries = $this->countries->getCountries($exclude, $include, $independent, $unMember);
        if($countries) {
            $result = $countries;
        }
        return $result;
    }

}
