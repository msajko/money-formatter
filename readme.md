# Money To Text converter

### Supported money formats:
  * set amount
    * country_code formats `setAmount(amount, country_code)`
      * {us,gb,au,..} `12,432.23` `$12,432.23` `£12,432.23` `EUR 12,432.23` ...
      * {de,at,es,..} `12.432,23` `12 432,23` `12 432,23 EUR` `12.432,23 €` ...
      * {fr} `12 432,23` `12 432,23 EUR` `12 432,23 €`
      * {ch} `12'432.23` `fr. 12'432.23`
      * {dz,eg,iq,sa} `12,432.23` `12,432.232 ج.م.‏` `12,432.232 ج.م.‏`
      * croatian money format e.q. `12.432,23` or `12.432,23 Kn`
      * others ...
    * integer, double `setAmountDirect()`
  * get pronunciation  `get(money, penny, separator)`
    * {en} `get('£', 'pence',' and')`
-> `twelve thousand four hundred thirty-two £ and twenty-three pence`
    * {de} `get('€', 'Cent', ' und')`
-> `zwölf­tausend­vier­hundert­zwei­und­dreißig € und drei­und­zwanzig Cent`
    * {it} `get('€', '¢', ' e')`
-> `dodici­mila­quattro­cento­trenta­due € e venti­tré ¢`
    * {hr} `getHr('€', 'centa', ' i')` [intl independent]
-> `dvanaesttisućačetiristotridesetidvije kune i dvadesetitri lipe`
    * others ...


### How to use
`composer require msajko/money-formatter`

or

`git clone https://github.com/msajko/money-formatter` create `index.php`:
```php
<?php
  use Msajko\MoneySpellOut;

  //if you not using composer
  include_once('src/money-formatter.php');

  //$amount=(rand(1, 9999).','.str_pad( rand(0, 99),2,'0',STR_PAD_LEFT));

  $amount='12.432,23';
  $money = new MoneySpellOut('de', $amount);
  echo 'DE: "'.$amount.'" => '.$money->get('€', '¢',' und').PHP_EOL;

  $amount='12.432,23 €';
  $money->setAmount($amount, 'it');
  $money->setCountrycode('it');
  echo 'IT: "'.$amount.'" => '.$money->get('€', '¢',' e').PHP_EOL;

  $amount='12 432,23 €';
  $money->setCountrycode('fr');
  $money->setAmount($amount, 'fr');
  echo 'FR: "'.$amount.'" => '.$money->get('€', '¢',' et').PHP_EOL;

  $amount='12.432,23 EUR';
  $money->setCountrycode('es');
  $money->setAmount($amount, 'es');
  echo 'ES: "'.$amount.'" => '.$money->get('€', '¢',' y').PHP_EOL;

  $amount='€12,432.23';
  $money->setCountrycode('gb');
  $money->setAmount($amount, 'gb');
  echo 'GB: "'.$amount.'" => '.$money->get('£', 'pence',' and').PHP_EOL;

  $amount='$12,432.23';
  $money->setCountrycode('us');
  $money->setAmount($amount, 'us');
  echo 'US: "'.$amount.'" => '.$money->get('$', '¢',' &').PHP_EOL;

  echo PHP_EOL;
  $money->setCountrycode('hr');
  echo 'HR(1): "'.$amount.'" => '.$money->get('kuna', 'lipa', ' i').PHP_EOL;
  //no spacing & php_intl independent
  echo 'HR(2): "'.$amount.'" => '.$money->getHr().PHP_EOL;
```
and run `php index.php`

### You can try not to use this repository
enable **intl** php_extension and try:
```php
$amount=12432;
$nFormat = new NumberFormatter('de', NumberFormatter::SPELLOUT);
$nFormat->setTextAttribute(NumberFormatter::DEFAULT_RULESET, "%spellout-ordinal-feminine");

var_dump($nFormat->format($amount));
```

inspired by
  * http://trigeminal.fmsinc.com/samples/setlocalesample2.asp
  * [yii2 framework implementation Formatter::asSpellout()](http://intl.rmcreative.ru/site/number-formatting?locale=hr_HR)

plan to integrate
  * https://github.com/arius86/number-formatter
