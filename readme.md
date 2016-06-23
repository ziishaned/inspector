#Inspector
Inspector is PHP wrapper to search people profiles on different social networks e.g facebook, twitter, google+ etc.

##Installation
You can install the library using the following ways:

##Using Composer
You can install this through <a href="http://getcomposer.org/">Composer</a>, a dependency manager for PHP. Just run the below command:

```
composer require zeeshanu/Inspector
```

For further details you can find the package at <a href="https://packagist.org/packages/zeeshanu/inspector">Packagist</a>.

##Manual way
- Copy <code>src</code> to your codebase, perhaps to the vendor directory.
- Add the <code>Zeeshan\Inspector\Inspector</code> class to your autoloader or require the file directly.

##Getting Started
I'm going to use the following email address to demonstrate the usage of this php wrapper.

>ziishaned@gmail.com

```php
$inspector = new Inspector($apiKey);
$person = $inspector->getProfile("ziishaned@gmail.com");

$person->getPhotos();
$person->getContactInfo();
$person->getOrganizations();
$person->getDemographics();
$person->getSocialProfiles();
$person->getInterests();
$person->getEmail();
```

##Feedback
If you notice that there might be some improvements in code you can create a pull request or report an issue. You can also contact me at <a href="mailto:ziishaned@gmail.com">ziishaned@gmail.com</a>.

#Note
This php wrapper not run until you provide <a href="https://portal.fullcontact.com/signup">FullContact</a> API key. You need to signup on <a href="https://portal.fullcontact.com/signup">FullContact</a> to run this php wrapper. 
The Free plan of FullContact include:
- 500 matches per month.
- 60 matches per minute.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
