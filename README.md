# civicrm-cli-utils

Mixed bag of civicrm command line utils. Work in progress.

## Install
composer install
to fetch dependency: wp-cli/php-cli-tools

### Config file
You can place a `.conf` file in the root of the project to save yourself some typing. See includes/base.php ::`getConfig()`.
A good config to have in there is `CIVICRM_ROOT`.
Also see the option to specifcy column mappings for includes/base.php::`mapColumns()`

## Example
clean is an example usage of these utils. It deletes, un-deletes, as well as imports contacts piped to STDIN. Use the source, Luke.

## Caution
For pre-4.7 versions of civicrm, `cvCli()` requires a core hack to add --json output option.
 * https://gist.github.com/ginkgomzd/b26a750b2fbd3ce25950
Suggest using `dushCVApi()` if you can, which serves the same purpose.
PR's welcome to add wp-cli support.

## a hasty orientation over chat:
"clean" started off as an example integration... but then Toby generalized it... so... there ya go. I'm looking to figure out what will need to be extended
you should skim this file: https://github.com/ginkgostreet/civicrm-cli-utils/blob/master/includes/base.php
just look at the function names, `parseCsv()` being a key one.

oh right, getConfig is another.
that might be where you got hung-up last time.
that is not the only way to set this up, but probably the easiest... put a .conf file in the root of this project, and set the path to civicrm.

so... I think creating a file LIKE createContact.php
https://github.com/ginkgostreet/civicrm-cli-utils/blob/master/includes/createContact.php
.. e.g. createParticipant.php
yes, it involves coding... but it is pretty declarative.

the suffix `_run()` is what the core will look for to implement a command, e.g. createParticipant. You can see around the end of clean.php... it looks for a file that matches the command and then expects that loaded by that file... a function of similar name with the suffix, `_run()`.

so... `createContact_run()`... basically gets the global configs (which just has the path to Civi), and then sets some constants... and then it does:


    $main = 'processContactsForImport';
    withFile($input, $main);

which says... for each line of the input file, call the function `processContactsForImport.`
... which is defined in the same file.
... and that function, recieves the line, already parsed out into an array, and then uses the core utility to call the civicrm API.
