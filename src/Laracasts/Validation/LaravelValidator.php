<?php namespace Laracasts\Validation;

use Illuminate\Validation\Factory as Validator;

class LaravelValidator implements FactoryInterface {

	/**
	 * @var \Illuminate\Validation\Factory
	 */
	private $validator;

	/**
	 * @param Validator $validator
	 */
	function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Initialize validation
	 *
	 * @param array $formData
	 * @param array $rules
	 * @return \Illuminate\Validation\Validator
	 */
	public function make(array $formData, array $rules)
	{
		return $this->validator->make($formData, $rules);
	}

}