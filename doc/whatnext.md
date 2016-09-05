# What next?

Without having more detail I would ...

## technical

* If introducing long term relational storage I would introduce ORM and remove the uids as references (just keep for integrity check).
* I would write some unit tests around the validation (given a criteria to validate against for each attribute in the entity).
* Introduce API for UI or others to use.
* Add some custom validation exceptions to replace the generic ones that are thrown at the moment.
* Handle the exceptions 
* Write a PhpUnit bootstrap and test classes for unit tests to the limited validation.


### Other

* Add other common attributes to the models such a genre, etc.
* The application would require an interface so maybe an API, then a UI of sorts to utilise it.


Realistically I would move the base classes to a framework like Laravel and use it's validation functionality and ORM.


