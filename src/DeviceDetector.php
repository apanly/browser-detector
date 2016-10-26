<?php

namespace apanly\BrowserDetector;

class DeviceDetector implements DetectorInterface
{
	protected static $androidList = [
		'OPPO','RedMi','XiaoMi','Vivo','Samsung','HuaWei','Letv','Lenovo','HTC','Meizu','ZTE','ONEPLUS'
	];
    /**
     * Determine the user's device.
     *
     * @param Device $device
     * @param UserAgent $userAgent
     * @return bool
     */
    public static function detect(Device $device, UserAgent $userAgent)
    {
        $device->setName($device::UNKNOWN);

        /*iphone，ipad，windowphone*/
        $flag = self::checkIpad($device, $userAgent) ||self::checkIphone($device, $userAgent) || self::checkWindowsPhone($device, $userAgent);
        if( $flag ){
        	return true;
		}
        /*android*/
		if (stripos($userAgent->getUserAgentString(), 'android') !== false) {
			$device->setName(Device::Android);
			foreach (self::$androidList as $androidName ) {
				$funcName = 'check'. $androidName;
				if ( self::$funcName( $device, $userAgent ) ) {
					return true;
				}
			}
		}

		return false;

    }

    /**
     * Determine if the device is iPad.
     *
     * @param Device $device
     * @param UserAgent $userAgent
     * @return bool
     */
    private static function checkIpad(Device $device, UserAgent $userAgent)
    {
        if (stripos($userAgent->getUserAgentString(), 'ipad') !== false) {
            $device->setName(Device::IPAD);
            return true;
        }

        return false;
    }

    /**
     * Determine if the device is iPhone.
     *
     * @param Device $device
     * @param UserAgent $userAgent
     * @return bool
     */
    private static function checkIphone(Device $device, UserAgent $userAgent)
    {
        if (stripos($userAgent->getUserAgentString(), 'iphone;') !== false) {
            $device->setName(Device::IPHONE);
            return true;
        }

        return false;
    }

    /**
     * Determine if the device is Windows Phone.
     *
     * @param Device $device
     * @param UserAgent $userAgent
     * @return bool
     */
    private static function checkWindowsPhone(Device $device, UserAgent $userAgent)
    {
        if (stripos($userAgent->getUserAgentString(), 'Windows Phone') !== false) {
            if (preg_match('/Microsoft; (Lumia [^)]*)\)/', $userAgent->getUserAgentString(), $matches)) {
                $device->setName($matches[1]);
                return true;
            }

            $device->setName($device::WINDOWS_PHONE);
            return true;
        }
        return false;
    }


	private static function checkOPPO( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; OPPO') !== false) {
			$device->setName(Device::OPPO);
			return true;
		}

		return false;
	}

	private static function checkRedMi( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; redmi') !== false
			|| stripos($userAgent->getUserAgentString(), '; HM NOTE') !== false
		) {
			$device->setName(Device::REDMI);
			return true;
		}

		return false;
	}

	private static function checkXiaoMi( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; MI') !== false
			||  stripos($userAgent->getUserAgentString(), '; MI') !== false
		) {
			$device->setName(Device::XiaoMi);
			return true;
		}

		return false;
	}

	private static function checkVivo( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; vivo') !== false ) {
			$device->setName(Device::Vivo);
			return true;
		}

		return false;
	}


	private static function checkSamsung( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; SAMSUNG') !== false
			|| stripos($userAgent->getUserAgentString(), '; Nexus') !== false
			|| stripos($userAgent->getUserAgentString(), '; Galaxy') !== false
			|| stripos($userAgent->getUserAgentString(), '; SM-') !== false
		) {
			$device->setName(Device::SAMSUNG);
			return true;
		}

		return false;
	}

	private static function checkHuaWei( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), 'Honor') !== false
			|| stripos($userAgent->getUserAgentString(), 'HUAWEI') !== false
			|| stripos($userAgent->getUserAgentString(), '; H60-') !== false
		) {
			$device->setName(Device::HuaWei);
			return true;
		}

		return false;
	}

	private static function checkLetv( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; Letv') !== false
			|| stripos($userAgent->getUserAgentString(), '; Le ') !== false
		) {
			$device->setName(Device::Le);
			return true;
		}

		return false;
	}

	private static function checkLenovo( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; Lenovo') !== false ) {
			$device->setName(Device::Lenovo);
			return true;
		}

		return false;
	}

	private static function checkHTC( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; HTC') !== false ) {
			$device->setName(Device::HTC);
			return true;
		}

		return false;
	}

	private static function checkMeizu( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; MZ') !== false
			|| stripos($userAgent->getUserAgentString(), '; MX') !== false
			|| stripos($userAgent->getUserAgentString(), '; m1 note') !== false
			|| stripos($userAgent->getUserAgentString(), '; m2 note') !== false
		) {
			$device->setName(Device::Meizu);
			return true;
		}

		return false;
	}

	private static function checkZTE( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; ZTE') !== false ) {
			$device->setName(Device::ZTE);
			return true;
		}

		return false;
	}

	private static function checkONEPLUS( Device $device, UserAgent $userAgent )
	{
		if ( stripos($userAgent->getUserAgentString(), '; ONEPLUS') !== false ) {
			$device->setName(Device::ONEPLUS);
			return true;
		}

		return false;
	}

}
