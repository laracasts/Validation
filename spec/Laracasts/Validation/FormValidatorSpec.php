<?php

namespace spec\Laracasts\Validation;

use Laracasts\Validation\FactoryInterface;
use Laracasts\Validation\ValidatorInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FormValidatorSpec extends ObjectBehavior
{
	function let(FactoryInterface $validatorFactory)
	{
		$this->beAnInstanceOf('spec\Laracasts\Validation\ExampleValidator');
		$this->beConstructedWith($validatorFactory);
	}

	function it_validates_a_set_of_valid_data(FactoryInterface $validatorFactory, ValidatorInterface $validator)
	{
		$fakeFormData = ['username' => 'joe'];

		$validatorFactory->make($fakeFormData, $this->getValidationRules(), [])->willReturn($validator);
		$validator->fails()->willReturn(false);

		$this->validate($fakeFormData)->shouldReturn(true);
	}

	function it_throws_an_exception_for_invalid_form_data(FactoryInterface $validatorFactory, ValidatorInterface $validator)
	{
		$fakeFormData = ['username' => ''];

		$validatorFactory->make($fakeFormData, $this->getValidationRules(), [])->willReturn($validator);
		$validator->fails()->willReturn(true);
		$validator->errors()->willReturn([]);

		$this->shouldThrow('Laracasts\Validation\FormValidationException')->duringValidate($fakeFormData);
	}

	function it_accepts_a_command_object_in_lieu_of_an_input_array(FactoryInterface $validatorFactory, ValidatorInterface $validator)
	{
		$formDataAsCommand = new CommandStub;
		$formDataCastToArray = get_class_vars(get_class($formDataAsCommand));

		$validatorFactory->make($formDataCastToArray, $this->getValidationRules(), [])->willReturn($validator);

		$this->validate($formDataAsCommand)->shouldReturn(true);

	}
}

class ExampleValidator extends \Laracasts\Validation\FormValidator {
	protected $rules = ['username' => 'required'];
}

class CommandStub {
    public $username = 'JohnDoe';
}
