<?php
namespace CoreBundle\Api;

use Symfony\Component\HttpFoundation\Response;

/**
 * A wrapper for holding data to be used for a application/problem+json response
 */
class ApiProblem
{
    /**
     * Result status code
     *
     * @var int
     */
    private $statusCode;
    /**
     * Error type, default null
     *
     * @var null|string
     */
    private $type;
    /**
     * Error title
     *
     * @var string
     */
    private $title;
    /**
     * Extra data added to response
     *
     * @var array
     */
    private $extraData = array();
    const TYPE_VALIDATION_ERROR = 'validation_error';
    const TYPE_INVALID_REQUEST_BODY_FORMAT = 'invalid_body_format';
    const TYPE_INVALID_TOKEN = 'invalid_token';
    const TYPE_NOT_FOUND = 'not_found';
    const TYPE_UNAUTHORIZED = 'unauthorized';

    private static $titles = array(
        self::TYPE_VALIDATION_ERROR => 'There was a validation error',
        self::TYPE_INVALID_REQUEST_BODY_FORMAT => 'Invalid JSON format sent',
        self::TYPE_INVALID_TOKEN => 'Invalid token',
        self::TYPE_NOT_FOUND => 'Not found',
        self::TYPE_UNAUTHORIZED => 'Unauthorized',
    );
    /**
     * ApiProblem constructor.
     * @param $statusCode
     * @param int $type
     */
    public function __construct($statusCode, $type = null) {
        $this->statusCode = $statusCode;

        if($type === null) {
            // no type? The default is about:blank and the title should
            // be the standard status code message
            $type = 'about:blank';
            $title = isset(Response::$statusTexts[$statusCode]) ? Response::$statusTexts[$statusCode] : 'Unknown status code :(';
        } else {
            if (!isset(self::$titles[$type])) {
                throw new \InvalidArgumentException('No title for type '.$type);
            }
            $title = self::$titles[$type];
        }
        $this->type = $type;
        $this->title = $title;
    }
    /**
     * Return response to array
     *
     * @return array
     */
    public function toArray() {
        return array_merge($this->extraData, array(
            'status' => $this->statusCode,
            'type' => $this->type,
            'title' => $this->title,
        ));
    }
    /**
     * Add extra data to response
     *
     * @param string $name
     * @param mixed $value
     */
    public function set($name, $value) {
        $this->extraData[$name] = $value;
    }
    /**
     * @return int
     */
    public function getStatusCode() {
        return $this->statusCode;
    }
    /**
     * @return string
     */
    public function getTitle() {
        return $this->title;
    }
}