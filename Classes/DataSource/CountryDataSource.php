<?php
namespace NeosRulez\CountryDataSource\DataSource;

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\PersistenceManagerInterface;
use Neos\Utility\TypeHandling;
use Neos\Neos\Service\DataSource\AbstractDataSource;
use Neos\ContentRepository\Domain\Model\NodeInterface;

class CountryDataSource extends AbstractDataSource {

    /**
     * @Flow\Inject
     * @var \NeosRulez\CountryDataSource\Countries
     */
    protected $countries;

    /**
     * @var string
     */
    protected static $identifier = 'neosrulez-countries';

    /**
     * @inheritDoc
     * @return array
     */
    public function getData(NodeInterface $node = null, array $arguments = array()):array
    {
        $options = [];
        $metadata = $this->countries->loadMetaData();
        if($metadata) {
            foreach ($metadata as $i => $option) {
                $options[] = [
                    'label' => $option['flag'] . ' ' . $option['name']['common'] . (array_key_exists('native', $option['name']) ? (array_key_exists('bar', $option['name']['native']) ? (array_key_exists('common', $option['name']['native']['bar']) ? ' (' . $option['name']['native']['bar']['common'] . ')' : '') : '') : ''),
                    'value' => $option['cca2'],
                ];
            }
        }
        return $options;
    }

}
