<?php

/**
 * A PHP file to simplify response content creation.
 *
 * PHP version 8
 *
 * @category File
 * @package  App\Utils;
 * @author   Andrias Melianus S <it.andrias@borwita.co.id>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.borwita.co.id/
 */

namespace App\Utils;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

/**
 * A class to standardize JSON response from this system.
 *
 * PHP version 8
 *
 * @category Class
 * @package  App\Utils;
 * @author   Andrias Melianus S <it.andrias@borwita.co.id>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://www.borwita.co.id/
 */
class Responser2
{
    // Constants.
    private const REPLACE_PREVIOUS = false;
    private const INITIAL_VALUE = null;
    public const INDEX_TOKEN = 'token';
    public const INDEX_DATA = 'data';
    public const INDEX_MESSAGE = 'message';
    public const INDEX_VALIDATION_MESSAGE = 'validation_message';
    public const INDEX_ERROR_MESSAGE = 'error_message';
    public const INDEX_STATUS = 'status';
    public const STATUS_SUCCESS = 'success';
    public const STATUS_DUPLICATE = 'duplicate';
    public const STATUS_FORBIDDEN = 'forbidden';
    public const STATUS_NOT_FOUND = 'not_found';
    public const STATUS_CONFLICT = 'conflict';
    public const STATUS_FAIL = 'failed';
    // Properties.
    private $headers;
    private $token;
    private $data;
    private $message;
    private $validationMessage;
    private $errorMessage;
    private $status;
    private $httpStatus;

    /**
     * Constructor.
     *
     * @param array $headers Response headers.
     * @return void
     */
    public function __construct(array $headers = [])
    {
        $this->headers = $headers;
        $this->status = self::STATUS_SUCCESS;
        $this->httpStatus = Response::HTTP_OK;

        $this->token = self::INITIAL_VALUE;
        $this->data = self::INITIAL_VALUE;
        $this->message = self::INITIAL_VALUE;
        $this->validationMessage = self::INITIAL_VALUE;
        $this->errorMessage = self::INITIAL_VALUE;
    }

    /**
     * Set headers value.
     *
     * @param array $headers Headers value.
     * @return self
     */
    public function setHeaders(array $headers): self
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Get headerrs value.
     *
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set token value.
     * Value will be set at the first call, unless $replacePrevious is true.
     *
     * @param string $token           Token value.
     * @param bool   $replacePrevious Replace previous value.
     * @return self
     */
    public function setToken(string $token, bool $replacePrevious = self::REPLACE_PREVIOUS): self
    {
        $shouldReplacePrevious = $replacePrevious || $this->token == self::INITIAL_VALUE;
        if ($shouldReplacePrevious) {
            $this->token = $token;
        }

        return $this;
    }

    /**
     * Get token value.
     *
     * @return string|null
     */
    public function getToken(): string | null
    {
        return $this->token;
    }

    /**
     * Set data value.
     * Value will be set at the first call, unless $replacePrevious is true.
     *
     * @param mixed $data            Data to be sent.
     * @param bool  $replacePrevious Replace previous value.
     * @return self
     */
    public function setData(mixed $data, bool $replacePrevious = self::REPLACE_PREVIOUS): self
    {
        $shouldReplacePrevious = $replacePrevious || $this->data == self::INITIAL_VALUE;
        if ($shouldReplacePrevious) {
            $this->data = $data;
        }

        return $this;
    }

    /**
     * Get the data value.
     *
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->data;
    }

    /**
     * Set message content.
     * Value will be set at the first call, unless $replacePrevious is true.
     *
     * @param mixed $message         Message to be sent.
     * @param bool  $replacePrevious Replace previous value.
     * @return self
     */
    public function setMessage(mixed $message, bool $replacePrevious = self::REPLACE_PREVIOUS): self
    {
        $shouldReplacePrevious = $replacePrevious || $this->message == self::INITIAL_VALUE;
        if ($shouldReplacePrevious) {
            $this->message = $message;
        }

        return $this;
    }

    /**
     * Get message content.
     *
     * @return mixed
     */
    public function getMessage(): mixed
    {
        return $this->message;
    }

    /**
     * Set validation message value.
     * Value will be set at the first call, unless $replacePrevious is true.
     *
     * @param mixed $validationMessage Validation message to be sent.
     * @param bool  $replacePrevious   Replace previous value.
     * @return self
     */
    public function setValidationMessage(mixed $validationMessage, bool $replacePrevious = self::REPLACE_PREVIOUS): self
    {
        $shouldReplacePrevious = $replacePrevious || $this->validationMessage == self::INITIAL_VALUE;
        if ($shouldReplacePrevious) {
            $this->validationMessage = $validationMessage;
        }

        return $this;
    }

    /**
     * Get validation message value.
     *
     * @return mixed
     */
    public function getValidationMessage(): mixed
    {
        return $this->validationMessage;
    }

    /**
     * Set error message value.
     * Value will be set at the first call, unless $replacePrevious is true.
     *
     * @param mixed $errorMessage    Error message to be sent.
     * @param bool  $replacePrevious Replace previous value.
     * @return self
     */
    public function setErrorMessage(mixed $errorMessage, bool $replacePrevious = self::REPLACE_PREVIOUS): self
    {
        $shouldReplacePrevious = $replacePrevious || $this->errorMessage == self::INITIAL_VALUE;
        if ($shouldReplacePrevious) {
            $this->errorMessage = $errorMessage;
        }

        return $this;
    }

    /**
     * Get error message value.
     *
     * @return mixed
     */
    public function getErrorMessage(): mixed
    {
        return $this->errorMessage;
    }

    /**
     * Get status value.
     *
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * Set the response status as success.
     * HTTP status equivalent to 200.
     *
     * @return self
     */
    public function setAsSuccess(): self
    {
        $this->status = self::STATUS_SUCCESS;
        $this->httpStatus = Response::HTTP_OK;

        return $this;
    }

    /**
     * Set the response status as duplicate.
     * HTTP status equivalent to 422.
     *
     * @return self
     */
    public function setAsDuplicate(): self
    {
        $this->status = self::STATUS_DUPLICATE;
        $this->httpStatus = Response::HTTP_UNPROCESSABLE_ENTITY;

        return $this;
    }

    /**
     * Set the response status as forbidden.
     * HTTP status equivalent to 403.
     *
     * @return self
     */
    public function setAsForbidden(): self
    {
        $this->status = self::STATUS_FORBIDDEN;
        $this->httpStatus = Response::HTTP_FORBIDDEN;

        return $this;
    }

    /**
     * Set the response status as not found.
     *
     * @return self
     */
    public function setAsNotFound(): self
    {
        $this->status = self::STATUS_NOT_FOUND;
        $this->httpStatus = Response::HTTP_NOT_FOUND;

        return $this;
    }

    /**
     * Set the response status as conflict.
     * HTTP status equivalent to 422.
     *
     * @return self
     */
    public function setAsConflict(): self
    {
        $this->status = self::STATUS_CONFLICT;
        $this->httpStatus = Response::HTTP_UNPROCESSABLE_ENTITY;

        return $this;
    }

    /**
     * Set the response status as validation fails.
     * HTTP status equivalent to 422.
     *
     * @return self
     */
    public function setAsValidationFails(): self
    {
        $this->status = self::STATUS_FAIL;
        $this->httpStatus = Response::HTTP_UNPROCESSABLE_ENTITY;

        return $this;
    }

    /**
     * Set the response status as fail.
     * HTTP status equivalent to 400.
     *
     * @return self
     */
    public function setAsRequestFailure(): self
    {
        $this->status = self::STATUS_FAIL;
        $this->httpStatus = Response::HTTP_BAD_REQUEST;

        return $this;
    }

    /**
     * Set the response status as server error/failure.
     * HTTP status equivalent to 500.
     *
     * @return self
     */
    public function setAsServerFailure(): self
    {
        $this->status = self::STATUS_FAIL;
        $this->httpStatus = Response::HTTP_INTERNAL_SERVER_ERROR;

        return $this;
    }

    /**
     * Get the structured response content.
     * NOTE: Adjust the content structure according to your need here!
     *
     * @return array
     */
    public function getContent(): array
    {
        $content = [];
        $content[self::INDEX_DATA] = $this->data;
        $content[self::INDEX_STATUS] = $this->status;
        if ($this->token) {
            $content[self::INDEX_TOKEN] = $this->token;
        }
        if ($this->message) {
            $content[self::INDEX_MESSAGE] = $this->message;
        }
        if ($this->validationMessage) {
            $content[self::INDEX_VALIDATION_MESSAGE] = $this->validationMessage;
        }
        if ($this->errorMessage) {
            $content[self::INDEX_ERROR_MESSAGE] = $this->errorMessage;
        }

        return $content;
    }

    /**
     * Create JSON response ready to be returned by controller.
     *
     * @return JsonResponse
     */
    public function send(): JsonResponse
    {
        return response()
            ->json($this->getContent(), $this->httpStatus, $this->headers);
    }
}
