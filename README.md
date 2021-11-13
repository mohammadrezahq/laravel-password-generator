# Mor/PassGen

### Password Generator for Laravel

Install package with composer:

```
composer require mor/passgen
```

#### Generate 

```
$length = 8 ; // default 8
$useSmallLetters = true; // default true
$useCapitalLetters = true; // default false
$useSmallLetters = true; // default false
$useSmallLetters = true; // default false

$pass = Passgen::Generate($length, $useSmallLetters, $useCapitalLetters, $useNumbers, $useSpecialChars);

```

#### Using orm

```
$pass = new Passgen();
$pass->small(); // Use small letters
$pass = $pass->make($length); // Return generated password.
```

##### Options

```
$pass->capital(); // Use capital letters

$pass->number(); // Use number

$pass->special(); // Uuse special characters

$pass->contain('abc@7'); // Generated password should have these characters.

// Also you can pass an array

$pass->contain(['a','b','c', '@','7']);

$pass->notContain('sh4'); // Generated password should not have these characters. (also can pass an array)

```

##### extra

```
$string = 'abcdefg';
$reOrder = Passgen::reOrder($string); // This will re-order the string: something like 'degfcab'.
```