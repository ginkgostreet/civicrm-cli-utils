# civicrm-cli-utils

Mixed bag of civicrm command line utils. Work in progress.

## Install
composer install
to fetch dependency: wp-cli/php-cli-tools

## Example
clean is an example usage of these utils. It deletes, un-deletes, as well as imports contacts piped to STDIN. Use the source, Luke.

## Caution
For pre-4.7 versions of civicrm, cvCli() requires a core hack to add --json output option.
 * https://gist.github.com/ginkgomzd/b26a750b2fbd3ce25950
Suggest using dushCVApi() if you can, which serves the same purpose.
PR's welcome to add wp-cli support.
