# MLy-Phonebook
simple phone book web app 
Built on Yii1 Framework using PHP 7.3
working example is located at http://199.250.202.208/~vldktz/
basically the app has 4 pages: 
1. main page is for users search including link to details and deletd button
2. user edit page including links to address page and company page
3. user company page
4. user address page

user search page uses async calls to the server with the query given in the search input and populate the results to the page.

controllers are located in protected/controllers folder.

models are located in protected/models folder.

views are located in protected/views folder.

JS file is located in jscript/index folder.

no CSS files used.

FrontEnd styling Framework was provided by Bootstrap 4.
DB migration from https://jsonplaceholder.typicode.com/users via migration system provided by the Framework (including creating the DB and populating it).
