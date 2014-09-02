> If you are using Laravel 4.3, this package is unnecessary. Instead, leverage the new form request classes to perform your validation.

## Install With Composer

```js
"require": {
    "laracasts/validation": "~1.0"
}
```

And then, if using Laravel (not required), add the service provider to `app/config/app.php` in the `providers` array.

```php
'Laracasts\Validation\ValidationServiceProvider'
```

## Usage

Here's an example. Imagine that you need validation for a login form. First, create an object to contain the necessary rules:

```php
<?php namespace MyApp\Forms;

use Laracasts\Validation\FormValidator;

class Login extends FormValidator {

	/**
	 * Validation rules for logging in
	 *
	 * @var array
	 */
	protected $rules = [
		'username' => 'required',
		'password' => 'required'
	];

}
```

Next, pull this object into your controller (or wherever you perform your validation).

```php
use MyApp\Forms\Login as LoginForm;
use Laracasts\Validation\FormValidationException;

// ...

protected $loginForm;

public function __construct(LoginForm $loginForm)
{
    $this->loginForm = $loginForm;
}

public function store()
{
    $input = Input::all();

    try
    {
        $this->loginForm->validate($input);

        // login user, do whatever, redirect
    }
    catch (FormValidationException $e)
    {
        return Redirect::back()->withInput()->withErrors($e->getErrors());
    }

}
```

If validation passes, `true` will be returned. Otherwise, a `FormValidationException` exception will be thrown. You can either catch that within your controller, or pass it to, for example, `global.php` for handling. Either works.

The key is that you'll create a dedicated class for each form that you need to validate. For instance, if a user can register for your site, then you'll have a `Registration` form object. Maybe something like:

```php
<?php namespace MyApp\Forms;

use Laracasts\Validation\FormValidator;

class Registration extends FormValidator {

	/**
	 * Validation rules for registering
	 *
	 * @var array
	 */
	protected $rules = [
		'username' => 'required',
		'email'    => 'required|unique:users',
		'age'      => 'required|integer',
		'gender'   => 'in:male,female',
		'password' => 'required|confirmed'
	];

}
```

Now, just inject this object into your controller or application service, and call a `validate()` method on it.

```php
$this->registrationForm->validate(Input::all());
```
