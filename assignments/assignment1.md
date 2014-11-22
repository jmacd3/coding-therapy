#CalculateChange.php

## Part 1
Write a program that calculates the change due in a transaction. It should run from the command line and take two unnamed arguments: amountDue and amountPaid. The output should list the total change due and then the denominations needed to make the change. For example:


##Sample usage/output

```bash
$ php calculateChange 2.25 5.00
2.75
One Dollar: 2
Quarter: 3
```

## Part 2 Dynamic Denominations

The program should now accept an optional 3rd parameter a file path, which, if present, contains a path to a file defining a PHP array which specifies the denominations present in the currency with their values and names. For instance, a file representing US currency would look like this:

```php
#denominations.php
$currency = [
['name'  => 'dollar',
 'value' => 1],
['name' => 'penny',
'value' => .01]
] etc ...;
```
If no file is present, default to US denominations.

If it is not possible to completely make change with the given denominations show how much change you can make and how much is left over.
