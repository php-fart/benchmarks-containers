<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: user.proto

namespace App\User\DTO;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\RepeatedField;

/**
 * Generated from protobuf message <code>app.Profile</code>
 */
class Profile extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string firstName = 1;</code>
     */
    protected $firstName = '';
    /**
     * Generated from protobuf field <code>string lastName = 2;</code>
     */
    protected $lastName = '';
    /**
     * Generated from protobuf field <code>string phone = 3;</code>
     */
    protected $phone = '';
    /**
     * Generated from protobuf field <code>.app.Address address = 4;</code>
     */
    protected $address = null;
    /**
     * Generated from protobuf field <code>repeated .app.SocialAccount accounts = 5;</code>
     */
    private $accounts;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $firstName
     *     @type string $lastName
     *     @type string $phone
     *     @type \App\User\DTO\Address $address
     *     @type \App\User\DTO\SocialAccount[]|\Google\Protobuf\Internal\RepeatedField $accounts
     * }
     */
    public function __construct($data = NULL) {
        \App\User\GPBMetadata\User::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string firstName = 1;</code>
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Generated from protobuf field <code>string firstName = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setFirstName($var)
    {
        GPBUtil::checkString($var, True);
        $this->firstName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string lastName = 2;</code>
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Generated from protobuf field <code>string lastName = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setLastName($var)
    {
        GPBUtil::checkString($var, True);
        $this->lastName = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string phone = 3;</code>
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Generated from protobuf field <code>string phone = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setPhone($var)
    {
        GPBUtil::checkString($var, True);
        $this->phone = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.app.Address address = 4;</code>
     * @return \App\User\DTO\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Generated from protobuf field <code>.app.Address address = 4;</code>
     * @param \App\User\DTO\Address $var
     * @return $this
     */
    public function setAddress($var)
    {
        GPBUtil::checkMessage($var, \App\User\DTO\Address::class);
        $this->address = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .app.SocialAccount accounts = 5;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getAccounts()
    {
        return $this->accounts;
    }

    /**
     * Generated from protobuf field <code>repeated .app.SocialAccount accounts = 5;</code>
     * @param \App\User\DTO\SocialAccount[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setAccounts($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \App\User\DTO\SocialAccount::class);
        $this->accounts = $arr;

        return $this;
    }

}
