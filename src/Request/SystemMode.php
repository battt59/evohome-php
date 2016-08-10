<?php

namespace Nickpeirson\Evohome\Request;

class SystemMode extends TokenAbstract
{
    const MODE_NORMAL = 0;
    const MODE_HEATINGOFF = 1;
    const MODE_ECO = 2;
    const MODE_AWAY= 3;
    const MODE_DAYOFF= 4;
    const MODE_CUSTOM= 6;


    protected $systemId;
    protected $mode;
    protected $timeUntil;
    protected $path = '';
    

    public function __construct($systemId, $mode)
    {
        $this->systemId = $systemId;
        $this->mode = $mode;
    }

    public function getPath()
    {
		$path = sprintf('temperatureControlSystem/%s/mode', $this->systemId);
        return parent::getPath().$path;
    }
    
    public function getOptions()
    {
        $options = parent::getOptions();
        $options['json'] = [
            'SystemMode' => $this->mode,
            //'TimeUntil' => 'None',
            'Permanent' => 'True'
        ];
        if (!empty($this->timeUntil)) {
            $options['json']['TimeUntil'] = $this->timeUntil->format(\DateTime::ATOM);
        }

        return $options;
    }

    public function getMethod()
    {
        return 'put';
    }
}
