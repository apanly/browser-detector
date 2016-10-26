<?php

namespace apanly\BrowserDetector;

class Device
{
    const UNKNOWN = 'unknown';

    const IPAD = 'iPad';
    const IPHONE = 'iPhone';
    const WINDOWS_PHONE = 'Windows Phone';
    const Android = 'Android';
    const OPPO = 'OPPO';
    const REDMI = 'Redmi';
    const XiaoMi = 'XiaoMi';
    const Le = 'Letv';
    const Vivo = 'Vivo';
    const SAMSUNG = 'Samsung';
    const HuaWei = 'HuaWei';
    const Lenovo = 'Lenovo';
    const HTC = 'HTC';
    const Meizu = 'Meizu';
    const ZTE = 'ZTE';
    const ONEPLUS = 'ONEPLUS';

    /**
     * @var string
     */
    private $name;

    /**
     * @var UserAgent
     */
    private $userAgent;

    /**
     * @param null|string|UserAgent $userAgent
     *
     * @throws \apanly\BrowserDetector\InvalidArgumentException
     */
    public function __construct($userAgent = null)
    {
        if ($userAgent instanceof UserAgent) {
            $this->setUserAgent($userAgent);
        } elseif (null === $userAgent || is_string($userAgent)) {
            $this->setUserAgent(new UserAgent($userAgent));
        } else {
            throw new InvalidArgumentException();
        }
    }

    /**
     * @param UserAgent $userAgent
     *
     * @return $this
     */
    public function setUserAgent(UserAgent $userAgent)
    {
        $this->userAgent = $userAgent;

        return $this;
    }

    /**
     * @return UserAgent
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    /**
     * @return string
     */
    public function getName()
    {
        if (!isset($this->name)) {
            DeviceDetector::detect($this, $this->getUserAgent());
        }

        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->name = (string)$name;

        return $this;
    }
}
