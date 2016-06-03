<?php
namespace Tch\Manivo\Resource\App;

use BEAR\Resource\ResourceObject;
use Parse\ParseACL;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;
use Tch\Manivo\Annotation\ParseExceptionThrowable;

class Incomes extends ResourceObject
{
    /**
     * @param $sessionToken
     * @param null $objectId
     * @return $this
     *
     * @ParseExceptionThrowable
     */
    public function onGet($sessionToken, $objectId = null)
    {
        $query = new ParseQuery('Income');

        if (!is_null($objectId)) {
            $query->get($objectId);
        }

        ParseUser::become($sessionToken);
        $this['incomes'] = $query->find();

        return $this;
    }

    /**
     * @param $sessionToken
     * @param $date
     * @param $amount
     * @return $this
     *
     * @ParseExceptionThrowable
     */
    public function onPost($sessionToken, $date, $amount)
    {
        $user = ParseUser::become($sessionToken);

        $income = new ParseObject('Income');
        $income->set('date', new \DateTime($date));
        $income->set('amount', intval($amount));
        $income->set('user', $user);
        $income->setACL(ParseACL::createACLWithUser($user));

        $income->save();
        $this['income'] = $income;

        return $this;
    }
}
