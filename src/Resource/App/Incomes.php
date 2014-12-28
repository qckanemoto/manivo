<?php
namespace Qck\Manivo\Resource\App;

use BEAR\Resource\Code;
use BEAR\Resource\ResourceObject;
use Parse\ParseACL;
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseUser;

class Incomes extends ResourceObject
{
    /**
     * @param $sessionToken
     * @param null $objectId
     * @return $this
     */
    public function onGet($sessionToken, $objectId = null)
    {
        $query = new ParseQuery('Income');

        if (!is_null($objectId)) {
            try {
                $query->get($objectId);
            } catch (ParseException $e) {
                $this['error'] = [
                    'code' => $e->getCode(),
                    'message' => $e->getMessage(),
                ];
                $this->code = Code::NOT_FOUND;

                return $this;
            }
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
     */
    public function onPost($sessionToken, $date, $amount)
    {
        $user = ParseUser::become($sessionToken);

        $income = new ParseObject('Income');
        $income->set('date', new \DateTime($date));
        $income->set('amount', intval($amount));
        $income->set('user', $user);
        $income->setACL(ParseACL::createACLWithUser($user));

        try {
            $income->save();
            $this['income'] = $income;

        } catch (ParseException $e) {
            $this['error'] = [
                'code' => $e->getCode(),
                'message' => $e->getMessage(),
            ];
            $this->code = Code::BAD_REQUEST;
        }

        return $this;
    }
}
