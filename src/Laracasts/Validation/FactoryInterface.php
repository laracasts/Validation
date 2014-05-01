<?php namespace Laracasts\Validation;

interface FactoryInterface {

    /**
     * Initialize validator
     *
     * @param array $formData
     * @param array $rules
     * @return ValidatorInterface
     */
	public function make(array $formData, array $rules);

} 