<?php namespace Laracasts\Validation;

use Laracasts\Validation\FactoryInterface as ValidatorFactory;
use Laracasts\Validation\ValidatorInterface as ValidatorInstance;

abstract class FormValidator {

	/**
	 * @var ValidatorFactory
	 */
	protected $validator;

	/**
	 * @var ValidatorInstance
	 */
	protected $validation;
	
	/**
	 * @var array
	 */
	protected $messages = [];

	/**
	 * @param ValidatorFactory $validator
	 */
	function __construct(ValidatorFactory $validator)
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
		$this->validation = $this->validator->make(
			$formData,
			$this->getValidationRules(),
			$this->getValidationMessages()
		);

		if ($this->validation->fails())
		{
			throw new FormValidationException('Validation failed', $this->getValidationErrors());
		}

		return true;
	}

	/**
	 * @return array
	 */
	public function getValidationRules()
	{
		return $this->rules;
	}

	/**
	 * @return mixed
	 */
	public function getValidationErrors()
	{
		return $this->validation->errors();
	}
	
	/**
	 * @return mixed
	 */
	public function getValidationMessages()
	{
		return $this->messages;
	}

}
