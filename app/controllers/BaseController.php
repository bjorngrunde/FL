<?php


use Family\Commanding\ValidationCommandBus;
class BaseController extends Controller {

    protected $CommandBus;

    function __construct(ValidationCommandBus $commandBus)
    {
        $this->CommandBus = $commandBus;
    }
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
