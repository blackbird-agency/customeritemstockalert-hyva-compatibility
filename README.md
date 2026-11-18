# Blackbird Customer Item Stock Alert Hÿva Compatibility

[![Latest Stable Version](https://img.shields.io/packagist/v/blackbird/customeritemstockalert-hyva-compatibility.svg?style=flat-square)](https://packagist.org/packages/blackbird/customeritemstockalert-hyva-compatibility)
[![License: MIT](https://img.shields.io/github/license/blackbird-agency/customeritemstockalert-hyva-compatibility.svg?style=flat-square)](./LICENSE.txt)

Compat module for Blackbird Customer Item Stock Alert on Magento 2 using a Hyvä Theme. The back-in-stock alert gets
the same features as on Luma, rewritten with Alpine.js, Tailwind CSS and the Hyvä modal: alert button on the product
page (out of stock products, configurable products with out of stock variants), subscription dialog (email prefilled
for logged-in customers, one checkbox per out of stock variant) and the "My Product Alerts" customer account page.
This requires:
- A [Hyvä Theme](https://www.hyva.io/) license
- A License to [Blackbird Customer Item Stock Alert](https://store.bird.eu/)

The module is only active on Hyvä themes (Hyvä compat module fallback); a Luma store is not affected.

## Requirements

* PHP >= 8.1
* Hÿva Theme: ^1.5 (native `<dialog>` modals)
* Blackbird Customer Item Stock Alert version: ^100.0.16

## Setup

Get the package

Composer Package:
```composer require blackbird/customeritemstockalert-hyva-compatibility```

Zip Package:
Unzip the package in app/code/Blackbird/CustomerItemStockAlertHyvaCompatibility, from the root of your Magento instance.


## Install the module

Go to your Magento root directory and run the following magento commands:

```
php bin/magento setup:upgrade
php bin/magento hyva:config:generate
```

Then rebuild the Tailwind CSS of your Hyvä theme (`npm run build` in `web/tailwind`) so the module's templates are
included.

## Support

- If you have any issue with this code, feel free to [open an issue](https://github.com/blackbird-agency/customeritemstockalert-hyva-compatibility/issues/new).
- If you want to contribute to this project, feel free to [create a pull request](https://github.com/blackbird-agency/customeritemstockalert-hyva-compatibility/compare).

## Contact

For further information, contact us:

- by email: support@bird.eu
- or by form: [https://black.bird.eu/en/contacts/](https://black.bird.eu/contacts/)

## Authors

- [**Blackbird Team**](https://github.com/blackbird-agency) - *Maintainer* -

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE.txt) file for details.

***That's all folks!***
