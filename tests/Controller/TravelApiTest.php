<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 02/04/2018
 * Time: 15:53
 */

namespace tests\Controller;


use Lakion\ApiTestCase\JsonApiTestCase;
use Symfony\Component\HttpFoundation\Response;

class TravelApiTest extends JsonApiTestCase
{
    private static $defaultHeaders;
    private static $authorizedHeaders;

    public static function setUpBeforeClass() {
        self::bootKernel();

        $token = self::$kernel->getContainer()->get('lexik_jwt_authentication.encoder')->encode([
            'username' => 'user1@example.com',
            'exp' => time() + 3600
        ]);

        self::$defaultHeaders = [
            'CONTENT_TYPE' => 'application/json',
        ];

        self::$authorizedHeaders = [
            'HTTP_Authorization' => 'Bearer ' . $token,
            'CONTENT_TYPE' => 'application/json',
        ];
    }

    /**
     * Test forbidden access to user without token
     *
     * @test
     */
    public function list_travel_forbidden() {
        $this->client->request('GET', '/travels', [], [], self::$defaultHeaders);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'error/unauthorized_response', Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Test list of current & future travels
     *
     * @test
     */
    public function list_future_travel() {
        $this->client->request('GET', '/travels', [], [], self::$authorizedHeaders);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'travel/list_future_response', Response::HTTP_OK);
    }

    /**
     * Test list of past travels
     *
     * @test
     */
    public function list_past_travel() {
        $this->client->request('GET', '/travels', [
            'past' => true,
        ], [], self::$authorizedHeaders);

        $response = $this->client->getResponse();

        $this->assertResponse($response, 'travel/list_past_response', Response::HTTP_OK);
    }
}
