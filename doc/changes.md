# Not requiring correction..

* class typehints
* cool validation for addActor()
* uses exceptions
* has validation
* has autoloading
* has multiple commits


# Changed..

* **abstract Entity should’ve implemented EntityInterface otherwise getUUID() is unsafe**

    This now does.

* **not PHP7**

    I have included namespace grouping and function return types. I did not do php7 initially as deployments to my knowledge is not widespread (and my dev machine was at 5.6).

 * **addActor() could better move date handling functionality to Actor class ( e.g. Actor->isBornBefore(DateTime) )**

    I performed extract function on this and now resides in the Actor class.

* **doesn’t use Closure for getActors() sorting**

    I have removed this and created an inline function that does the same job (which is perfectly fine).

* **compareActors() could just use that fact that DateTime objects can be compared directly**

    I have changed this now

* **unsure to why Movie::generate() needs to exist - constructor should be used**

    Removed.

* **setTitle, generate and other methods have default argument values that aren’t valid and would throw an exception so why have them?**

    Corrected.

* **doesn’t use early return / bail and has very explicit variables and if / elses e.g.**

    I have extracted this into its own validation function, so that in future use more validation could be added and the function could be extracted into some class say RunTimeValidation and executed in some validation strategy pattern. (obviously this is not going anywhere, just thinking ahead)

* **Actor::setDob() could again just compare DateTime objects directly**

    Fixed.

* **doesn’t use JsonSerializable**

    Fixed.

* **catches exceptions and sprintfs them ( meaning they aren’t even output ) meaning all validation is wasted**

    Fixed, was meant to use printf.

* **not PSR-2**

    According to https://github.com/squizlabs/PHP_CodeSniffer/issues/878 PSR-2 is not compatible with php7 use groupings. However rest of files are.



# Unsure what to correct..
* **too many useless doc-blocks**

    I'm unsure which ones are useless, with the php7's return types I suppose most of the function doc blocks are not important, but documentation is important so I thought I'd leave then in ( you can always fold them with a decent text editor).


* **random whitespace**

    I'm unsure to where this is exactly (I could strip out if you told me where it was).

* **uses generic exceptions**

    I did put that I would create specific and defined Exceptions if I had more time for the task.

* **dislike the UUID generation**

    What did you dislike about it exactly? If I used a relational db I would use a row id, however as it stands I generates a unique id based on the values in that class that are the same each time the values are the same.

* **doesn’t use composer**

    This currently doesn't have any dependencies to require composer, so how should it use Composer?

