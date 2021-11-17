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
$count = 4; // Minimum count of characters (default = 0 means random)
$exact = true; // Exact number of count // if count = 4, exactly 4 charcters of this type will be found in password. (default = false)
$pass->small($count, $exact); 

$pass->capital(); // Use capital letters

$pass->number(); // Use number

$pass->special(); // Uuse special characters

$pass->contain('abc@7'); // Generated password should have these characters.

// Also you can pass an array

$pass->contain(['a','b','c', '@','7']);

$pass->notContain('sh4'); // Generated password should not have these characters. (also can pass an array)

```

##### extra

###### String to password

```
$string = 'something';

$type = 'before'; // Type of with: can be 'before' (add generated password before of string) or  'after' or 'both'

$pass->stringToPass($string)->with($length, $type, $useSmallLetters, $useCapitalLetters, $useNumbers, $useSpecialChars)->get();
```

###### Re order

```
$string = 'abcdefg';
$reOrder = Passgen::reOrder($string); // This will re-order the string: something like 'degfcab'.
```