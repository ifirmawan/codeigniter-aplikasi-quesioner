<?php

/**
* 
*/
class Instance_ci
{
	
	function __construct()
	{
		
	}

	/**
	 * __call
	 *
	 * Acts as a simple way to call model methods without loads of stupid alias'
	 *
	 * @param $method
	 * @param $arguments
	 * @return mixed
	 * @throws Exception
	 */
	public function __call($method, $arguments)
	{
		
	}

	/**
	 * __get
	 *
	 * Enables the use of CI super-global without having to define an extra variable.
	 *
	 * I can't remember where I first saw this, so thank you if you are the original author. -Militis
	 *
	 * @access	public
	 * @param	$var
	 * @return	mixed
	 */
	public function __get($var)
	{
		return get_instance()->$var;
	}
}