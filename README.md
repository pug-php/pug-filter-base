# jade-filter-base
Example for Jade-php filter, use this base to create and publish your own

## How to create and publish your own filter

Install composer: https://getcomposer.org/download/

Then create a project based on this package:

```shell
composer create-project kylekatarnls/jade-filter-base yourfilter
cd yourfilter
```
Replace **yourfilter** with the directory name you wish, composer will create
it and install jade-filter-base inside.

If your filter require somes other packages to work, add them with composer,
for example:

```shell
composer require kylekatarnls/sbp
```

NB: By default, the composer.json file is set to "minimum-stability": "stable",
but some packages have no stable version. To install them, set it to dev:

```json
"minimum-stability": "dev",
```
```shell
composer require neemzy/stylus
```

Then rename **src/Jade/Filter/Base.php** to **src/JadeFilter/YourFilter.php**
For example, to create a filter you will call with ```:foo```, call the file
Foo.php, ```:foo-bar-baz```, FooBarBaz.php and so on.

Then give the class inside this file the same name, and edit the **__invoke**
method, you get the filter node of the Jade structure tree and the Jade
compiler and you can treat each line to iterate on $node->block->nodes or
get all the text with ```$this->getNodeString($node, $compiler)```
Here begin the fun part, execute any action as you want then return a string
that will be rendered in the HTML.

## Test your filter

Please do not publish a filter with no test. Give us one or more examples in
the directory **examples** to see how to use your filter by creating a file
with .jade extension then create another file with the same name but .html
extension to show the result. (Replace or remove the basic example.)

You can now check that everyting work as expected with phpunit, execute at
your project root:

```shell
./vendor/bin/phpunit
```

If your filter render all your examples as expected, you get 100% and OK,
else you will see the difference between the expected result and the
rendered jade for each broken example.

## Configure it

To publish your filter, you will need an account on https://packagist.org
If you haven't already, create one. The username you choose will appear as
the filter author on http://jade-filters.selfbuild.fr/.

Now you can set the name of your package in **composer.json**. It must follow
this syntax: ```username/jade-filter-filtername```
or ```username/jade-php-filter-filtername``` with username your packagist
username and filtername the filter name as it will be called in the jade
template, so if you sign up as *dark-vador* on https://packagist.org and
create a package you will call with ```:foo-bar-baz``` in your template,
your **composer.json** should contains:
```json
{
    "name": "dark-vador/jade-filter-foo-bar-baz",
```

Then explain what your filter do in the description field.

## Document it

Replace the project **README.md** with informations about how to install,
for example:

```shell
composer require kylekatarnls/jade-filter-sbp
```

## Publish it

Now you can host your filter on any Git, Svn or Hg server.

We encourage you to use https://github.com as http://jade-filters.selfbuild.fr/
is optimized for it and you can follow this instructions: https://help.github.com/articles/adding-an-existing-project-to-github-using-the-command-line/

You can add Packagist as a service in GitHub with Settings >
Webhooks & services > Add service > Packagist, enter your username and
your token and each time you will draft a release ig GitHub or push a tag,
it will publish a version on Packagist and on http://jade-filters.selfbuild.fr/.
It can take one minute or two.

Last step, go to https://packagist.org/packages/submit and enter the URL of
your repository.
