# RAMCI API Package

This Library allows to query the RAMCI B2B API for registered users. 

You need the access details that were provided to you to make any calls to the API.
For exact parameters in the data array/JSON, refer to your offline documentation.

If you do not know what all this is about, then you probably do not need or want this library.

# Configuration

## .env file

Configuration via the .env file currently allows the following variables to be set:

- RAMCI\_BASE\_URL : the base URL for the API endpoint WITHOUT the command (report/json)
- RAMCI\_USERNAME : the username to access the API
- RAMCI\_PASSWORD : the password to ccess the API

###Example:
if the urls you have to generate the reports are
- http://api.endpoint/url/report
- http://api.endpoint/url/json

and your username is demouser with password demoPassword then: 

- RAMCI\_BASE\_URL='http://api.endpoint/url/'
- RAMCI\_USERNAME=demouser 
- RAMCI\_PASSWORD=demoPassword

## Available functions

```php
RAMCI::generateJSONFromArray($data)
```

This function takes an array of options for the RAMCI API and generates the JSON code
that can be submitted via the API Call. Example:
```php
      [
       'ProductType'   =>  'CHECK_DATE_COMPANY',
       'EntityName'    =>  'My Company Name',
       'EntityId'      =>  '123456789'
      ]
``` 
will generate
```
{
      "request" : {
            "ProductType":CHECK_DATE_COMPANY,
            "EntityName":My Company Name,
            "EntityId":12356789
      }
}
```



```php
RAMCI::getReport($requestJSON, $command='report', $sendJSON=true)
```

This function tries to retrieve the report data from RAMCI and returns the JSON response;
In case of a connectino error, it returns FALSE,

If the request was succesful but the query resulted in data related errors, the returned array will have the fields:

code  : contains the error code received from RAMCI
error : contains the error message received from RAMCI

A succesful request returns the JSON of the requested report

**OPTIONAL PARAMETER $command:**

By default the request calls the "report" endpoint you can change to the 'JSON' endpoint by sending
the optional parameter $command with a value of 'JSON' - 'pdf' is not supported by this function

**OPTIONAL PARAMETER $sendJSON:**
 
 If this parameter is set to false, the funcitno will return the data as an associative array. 
 The JSON tag names are the keys of the array, the JSON values obviously the data of the array

     
