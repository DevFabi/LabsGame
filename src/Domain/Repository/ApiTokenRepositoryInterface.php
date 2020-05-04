<?php


namespace App\Domain\Repository;


use App\Domain\Model\ApiToken;

interface ApiTokenRepositoryInterface
{
    /**
     * @return ApiToken[]
     */
    public function findAll() : array;

    /**
     * @param ApiToken $apiToken
     */
    public function add(ApiToken $apiToken);

    /**
     * @param int $id
     *
     * @return ApiToken
     */
    public function findOneById(int $id) : ApiToken;
}