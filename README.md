# Country DataSource for Neos CMS and Neos Flow

A package that provides a data source with all countries in the world including translations and other valuable data.

## Installation

The NeosRulez.CountryDataSource package is listed on packagist (https://packagist.org/packages/neosrulez/countrydatasource) - therefore you don't have to include the package in your "repositories" entry any more.

Just run:

```
composer require neosrulez/countrydatasource
```

## Usage

```html
countries = NeosRulez.CountryDataSource:Class.Countries {
    // Example: Shows everything except Aruba, Germany and Austria
    exclude = ${'AW,DE,AT'}
    independent = 'false'
    unMember = 'true'
}

countries2 = NeosRulez.CountryDataSource:Class.Countries {
    // Example: Only shows Austria and Germany
    include = ${'AT,DE'}
    independent = 'false'
    unMember = 'true'
}

renderer = afx`
    <ul>
        <Neos.Fusion:Loop items={props.countries} itemName="country">
            <li>{country.flag} {country.name.common}</li>
        </Neos.Fusion:Loop>
    </ul>
    <ul>
        <Neos.Fusion:Loop items={props.countries2} itemName="country">
            <li>{country.flag} {country.name.common}</li>
        </Neos.Fusion:Loop>
    </ul>
`
```


## Author

* E-Mail: mail@patriceckhart.com
* URL: http://www.patriceckhart.com
