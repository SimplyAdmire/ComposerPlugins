Composer Plugins
================

A collection of composer plugins for specific installation instruction
for composer packages.

PHP Codesniffer Standard installer
----------------------------------

The PHP Codesniffer Standard installer is able to install phpcs codesniffer
standards into the `<vender>/squizlabs/php_codesniffer/CodeSniffer/Standards/`
folder. By doing so the standard will be usable by calling `bin/phpcs --standard <standard>`.

### How To Use

* Find the package containing the codesniffs you want to use. This package should be
  a normal Codesniffing package containing a `ruleset.xml` and a `composer.json`.
* The composer package type has to be `phpcodesniffer-standard`
* The name of the package has to reflect the name of the standard (explained below)
* It's best if the package has a requirement to `simplyadmire/composer-plugins`. This
  is the only way to be sure the installer is available before the package is installed.
* Now add the package as a development dependency to your project
* Run `bin/phpcs -i` and see your standard listed

### Naming Rules

The name of the standard is derived from the composer packagekey. The part after the `/`
is taken as standard name. The first character is made uppercase, and all characters after
a `-` will be uppercased. So:

* `vendor/mysniffs` becomes `Mysniffs`
* `vendor/some-more-words` becomes `SomeMoreWords`

TYPO3 Specific
--------------

The TYPO3 community already has packages available on packagist, and as renaming packagenames
would be a bad practice we added 3 hardcoded standard names. Also the vendor name `TYPO3` will
always be enforced to be uppercase.

If you want to use the Flow sniffs you need to use our forks of the rules, we hope to get the
changes upstream into the main repository as soon as possible.

So for sniffing your TYPO3 Flow or TYPO3 Neos project, add the following repositories to your
composer.json:

```json
	{"type": "git", "url": "https://github.com/SimplyAdmire/TYPO3Flow.git"},
	{"type": "git", "url": "https://github.com/SimplyAdmire/TYPO3SniffPool.git"}
```

After that add a development requirement for the package `typo3-ci/typo3flow`.

Now you can sniff your packages with for example:

```
	bin/phpcs --extensions=php --standard=TYPO3Flow Packages/Application/My.Package
```