# Mor/PassGen

### Password Generator for Laravel

Install package with composer:

```
composer require mor/passgen
```

Use in project with this command:

```
use Mor\Passgen\Passgen;
```

#### Generate 

```
$length = 8 ; // default 8

$pass = Passgen::Generate($length, ['small', 'capital', 'number', 'special']);

```

#### Password Generator ORM

```
$pass = new Passgen();
$pass->small(); // Use small letters
$pass = $pass->make($length); // Return generated password.
```

##### Options

```
$count = 4; // Minimum count of characters (default = 0 means random)
$exact = true; // Exact number of count 
// if count = 4, exactly 4 charcters of this type will be found in the password. (default = false)

$pass->small($count, $exact); 

$pass->capital(); // Use capital letters

$pass->number(); // Use number

$pass->special(); // Uuse special characters

$pass->contain('abc@7'); // Generated password should have these characters.

// Also you can pass an array

$pass->contain(['a','b','c', '@','7']);

$pass->notContain('sh4'); // Generated password should not have these characters. (also can pass an array)

```

##### String to Password

```
$string = 'something';

$type = 'before'; // Type of with: can be 'before' (add generated password before of string) or  'after' or 'both'

$pass->stringToPass($string)->with($length, $type, $useSmallLetters, $useCapitalLetters, $useNumbers, $useSpecialChars)->get();
```

-------------------------------


##### Extra

###### Re Order

```
$string = 'abcdefg';
$reOrder = Passgen::reOrder($string); // This will re-order the string: something like 'degfcab'.
```

#### Advanced

##### Custom Characters

To add your custom characters, create a class like this:

```
<?php

// Default folder of chars
namespace Mor\Passgen\Chars;

use Mor\Passgen\App\PasswordGenerator\Char;

class Custom extends Char {

    // add custom characters as key
    public $characters = [
        '😀', '😁', '😛'
    ];

}

```

Then register your custom character inside Mor\Passgen\App\PasswordGenerator\Bootstrap.php

```
...
use namespace Mor\Passgen\Chars\Custom;
...


...
    public function __construct()
    {
        $this->registerChars([
            ...
            Custom::class,
            ...
        ]);
    }
...
```

To use custom characters just use name of class:

```

$pass = new Passgen();

Passgen::Generate(8, ['custom']); // e.g: '😛😛😀😛😛😛😁😀' (return 32 characters because of emojies)
$pass->custom()->make(8); // e.g: '😀😀😛😀😁😀😀😁'

```
<b>Warn:</b> for this example we made password with emojies, this <b>is not</b> recommended.

##### Custom Name for Custom Characters

To use custom name for characters add this to your custom character class:

```
public $name = 'CustomCharacter';
```

```
$pass = new Passgen();

Passgen::Generate(8, ['CustomCharacter']);
$pass->CustomCharacter()->make(8);

```