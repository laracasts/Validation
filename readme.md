## Install With Composer

```js
"require": {
    "laracasts/validation": "1.*"
}
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