<?php namespace Laracasts\Validation;

use Illuminate\Validation\Factory as Validator;
use Illuminate\Validation\Validator as ValidatorInstance;

abstract class FormValidator {

	/**
	 * @var Validator
	 */
	protected $validator;

	/**
	 * @var ValidatorInstance
	 */
	protected $validation;

	/**
	 *
	 * @param Validator $validator
	 */
	function __construct(Validator $validator)
	{
		$this->validator = $validator;
	}

	/**
	 * Validate the form data
	 *
	 * @param array $formData
	 * @return mixed
	 * @throws FormValidationException
	 */
	public function validate(array $formData)
	{
		$this->validation = $this->validator->make($formData, $this->getValidationRules());

		if ($this->validation->fails())
		{
			throw new FormValidationException('Validation failed', $this->getValidationErrors());
		}

		return true;
	}

	/**
	 * Get the validation rules
	 *
	 * @return array
	 */
	protected function getValidationRules()
	{
		return $this->rules;
	}

	/**
	 * Get the validation errors
	 *
	 * @return \Illuminate\Support\MessageBag
	 */
	protected function getValidationErrors()
	{
		return $this->validation->errors();
	}

}