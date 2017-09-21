<?php

/**
 * MQTT Client
 */

namespace Server\Asyn\MQTT\Message\Header;
use Server\Asyn\MQTT\Exception;
use Server\Asyn\MQTT\Message;


/**
 * Fixed Header definition for PINGREQ
 */
class PINGREQ extends Base
{
    /**
     * Default Flags
     *
     * @var int
     */
    protected $reserved_flags = 0x00;

    /**
     * PINGREQ does not have Packet Identifier
     *
     * @var bool
     */
    protected $require_msgid = false;

    /**
     * Decode Variable Header
     *
     * @param string & $packet_data
     * @param int    & $pos
     * @return bool
     * @throws Exception
     */
    protected function decodeVariableHeader(& $packet_data, & $pos)
    {
        throw new Exception('NO PINGREQ will be sent to client');
    }
}

# EOF