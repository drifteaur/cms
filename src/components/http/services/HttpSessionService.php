<?php
namespace Blocks;

/**
 * Extends CHttpSession to add support for setting the session folder and creating it if it doesn't exist.
 */
class HttpSessionService extends \CHttpSession
{
	/**
	 *
	 */
	public function init()
	{
		// Check if the config value has actually been set to true/false
		$configVal = $this->get('overridePHPSessionLocation');

		// If it's set to true, override the PHP save session path.
		if (is_bool($configVal) && $configVal === true)
		{
			$this->setSavePath(blx()->path->getSessionPath());
		}
		// Else if it's not false, then it must be 'auto', so let's attempt to check if we're on a distributed cache system
		else if ($configVal !== false)
		{
			if (strpos($this->getSavePath(), 'tcp://') === false)
			{
				$this->setSavePath(blx()->path->getSessionPath());
			}
		}

		parent::init();
	}

	// For consistency!
	/**
	 * @return bool
	 */
	public function isStarted()
	{
		return $this->getIsStarted();
	}
}
