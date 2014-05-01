<?php namespace Laracasts\Validation;

interface FactoryInterface {

	/**
	 * Initialize validator
	 *
	 * @return ValidatorInterface
	 */
	public function make();

} 