<?php

namespace Base\Core\Response;

/**
 * Class ResponseAbstract
 *
 * @package Base\Core
 * @subpackage Base\Core\Response
 */
abstract class ResponseAbstract
{
    /**
     * Body content
     * @var string
     */
    protected $body = '';

    /**
     * Exception stack
     * @var array
     */
    protected $exceptions = [];

    /**
     * Array of headers. Each header is an array with keys 'name' and 'value'
     * @var array
     */
    protected $headers = [];

    /**
     * Array of raw headers. Each header is a single string, the entire header to emit
     * @var array
     */
    protected $headersRaw = [];

    /**
     * HTTP response code to use in headers
     * @var int
     */
    protected $httpResponseCode = 200;

    /**
     * Flag; is this response a redirect?
     * @var boolean
     */
    protected $isRedirect = false;

    /**
     * Whether or not to render exceptions; off by default
     * @var boolean
     */
    protected $renderExceptions = false;

    /**
     * Flag; if true, when header operations are called after headers have been
     * sent, an exception will be raised; otherwise, processing will continue
     * as normal. Defaults to true.
     *
     * @see canSendHeaders()
     * @var boolean
     */
    public $headersSentThrowsException = true;

    /**
     * Normalize a header name
     *
     * Normalizes a header name to X-Capitalized-Names
     *
     * @param  string $name
     * @return string
     */
    protected function normalizeHeader($name)
    {
        $filtered = str_replace(array('-', '_'), ' ', (string) $name);
        $filtered = ucwords(strtolower($filtered));
        $filtered = str_replace(' ', '-', $filtered);
        return $filtered;
    }

    /**
     * Set a header
     *
     * If $replace is true, replaces any headers already defined with that
     * $name.
     *
     * @param string $name
     * @param string $value
     * @param boolean $replace
     * @return ResponseAbstract
     */
    public function setHeader($name, $value, $replace = false)
    {
        $this->canSendHeaders(true);
        $name  = $this->normalizeHeader($name);
        $value = (string) $value;

        if ($replace) {
            foreach ($this->headers as $key => $header) {
                if ($name == $header['name']) {
                    unset($this->headers[$key]);
                }
            }
        }

        $this->headers[] = array(
            'name'    => $name,
            'value'   => $value,
            'replace' => $replace
        );

        return $this;
    }

    /**
     * Set redirect URL
     *
     * Sets Location header and response code. Forces replacement of any prior
     * redirects.
     *
     * @param string $url
     * @param int $code
     * @return ResponseAbstract
     */
    public function setRedirect($url, $code = 302)
    {
        $this->canSendHeaders(true);
        $this->setHeader('Location', $url, true)
             ->setHttpResponseCode($code);

        return $this;
    }

    /**
     * Is this a redirect?
     *
     * @return boolean
     */
    public function isRedirect()
    {
        return $this->isRedirect;
    }

    /**
     * Return array of headers; see {@link $headers} for format
     *
     * @return array
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Clear headers
     *
     * @return ResponseAbstract
     */
    public function clearHeaders()
    {
        $this->headers = [];

        return $this;
    }

    /**
     * Clears the specified HTTP header
     *
     * @param  string $name
     * @return ResponseAbstract
     */
    public function clearHeader($name)
    {
        if (!count($this->headers)) {
            return $this;
        }

        foreach ($this->headers as $index => $header) {
            if ($name == $header['name']) {
                unset($this->headers[$index]);
            }
        }

        return $this;
    }

    /**
     * Set raw HTTP header
     *
     * Allows setting non key => value headers, such as status codes
     *
     * @param string $value
     * @return ResponseAbstract
     */
    public function setRawHeader($value)
    {
        $this->canSendHeaders(true);
        if ('Location' == substr($value, 0, 8)) {
            $this->isRedirect = true;
        }
        $this->headersRaw[] = (string) $value;
        return $this;
    }

    /**
     * Retrieve all {@link setRawHeader() raw HTTP headers}
     *
     * @return array
     */
    public function getRawHeaders()
    {
        return $this->headersRaw;
    }

    /**
     * Clear all {@link setRawHeader() raw HTTP headers}
     *
     * @return ResponseAbstract
     */
    public function clearRawHeaders()
    {
        $this->headersRaw = [];
        return $this;
    }

    /**
     * Clears the specified raw HTTP header
     *
     * @param  string $headerRaw
     * @return ResponseAbstract
     */
    public function clearRawHeader($headerRaw)
    {
        if (!count($this->headersRaw)) {
            return $this;
        }

        $key = array_search($headerRaw, $this->headersRaw);
        if ($key !== false) {
            unset($this->headersRaw[$key]);
        }

        return $this;
    }

    /**
     * Clear all headers, normal and raw
     *
     * @return ResponseAbstract
     */
    public function clearAllHeaders()
    {
        return $this->clearHeaders()
                    ->clearRawHeaders();
    }

    /**
     * Set HTTP response code to use with headers
     *
     * @param int $code
     * @throw \InvalidArgumentException
     * @return ResponseAbstract
     */
    public function setHttpResponseCode($code)
    {
        if (!is_int($code) || (100 > $code) || (599 < $code)) {
            throw new \InvalidArgumentException('Invalid HTTP response code');
        }

        if ((300 <= $code) && (307 >= $code)) {
            $this->isRedirect = true;
        } else {
            $this->isRedirect = false;
        }

        $this->httpResponseCode = $code;
        return $this;
    }

    /**
     * Retrieve HTTP response code
     *
     * @return int
     */
    public function getHttpResponseCode()
    {
        return $this->httpResponseCode;
    }

    /**
     * Can we send headers?
     *
     * @param boolean $throw Whether or not to throw an exception if headers have been sent; defaults to false
     * @return boolean
     * @throws \RuntimeException
     */
    public function canSendHeaders($throw = false)
    {
        $ok = headers_sent($file, $line);
        if ($ok && $throw && $this->headersSentThrowsException) {
            throw new \RuntimeException('Cannot send headers; headers already sent in ' . $file . ', line ' . $line);
        }

        return !$ok;
    }

    /**
     * Send all headers
     *
     * Sends any headers specified. If an {@link setHttpResponseCode() HTTP response code}
     * has been specified, it is sent with the first header.
     *
     * @return ResponseAbstract
     */
    public function sendHeaders()
    {
        // Only check if we can send headers if we have headers to send
        if (count($this->headersRaw) || count($this->headers) || (200 != $this->httpResponseCode)) {
            $this->canSendHeaders(true);
        } elseif (200 == $this->httpResponseCode) {
            // Haven't changed the response code, and we have no headers
            return $this;
        }

        $httpCodeSent = false;

        foreach ($this->headersRaw as $header) {
            if (!$httpCodeSent && $this->httpResponseCode) {
                header($header, true, $this->httpResponseCode);
                $httpCodeSent = true;
            } else {
                header($header);
            }
        }

        foreach ($this->headers as $header) {
            if (!$httpCodeSent && $this->httpResponseCode) {
                header($header['name'] . ': ' . $header['value'], $header['replace'], $this->httpResponseCode);
                $httpCodeSent = true;
            } else {
                header($header['name'] . ': ' . $header['value'], $header['replace']);
            }
        }

        if (!$httpCodeSent) {
            header('HTTP/1.1 ' . $this->httpResponseCode);
        }

        return $this;
    }

    /**
     * Set body content
     *
     * If $name is not passed, or is not a string, resets the entire body and
     * sets the 'default' key to $content.
     *
     * If $name is a string, sets the named segment in the body array to
     * $content.
     *
     * @param string $content
     * @return ResponseAbstract
     */
    public function setBody($content)
    {
        $this->body = $content;
        return $this;
    }

    /**
     * Clear body array
     *
     * With no arguments, clears the entire body array. Given a $name, clears
     * just that named segment; if no segment matching $name exists, returns
     * false to indicate an error.
     *
     * @return boolean
     */
    public function clearBody()
    {
        $this->body = '';
        return $this;
    }

    /**
     * Return the body content
     *
     * @return string|array|null
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Echo the body segments
     *
     * @return void
     */
    public function outputBody()
    {
        echo $this->body;
    }

    /**
     * Register an exception with the response
     *
     * @param \Exception $e
     * @return ResponseAbstract
     */
    public function setException(\Exception $e)
    {
        $this->exceptions[] = $e;
        return $this;
    }

    /**
     * Retrieve the exception stack
     *
     * @return array
     */
    public function getException()
    {
        return $this->exceptions;
    }

    /**
     * Has an exception been registered with the response?
     *
     * @return boolean
     */
    public function isException()
    {
        return !empty($this->exceptions);
    }

    /**
     * Whether or not to render exceptions (off by default)
     *
     * If called with no arguments or a null argument, returns the value of the
     * flag; otherwise, sets it and returns the current value.
     *
     * @param boolean $flag Optional
     * @return boolean
     */
    public function renderExceptions($flag = null)
    {
        if (null !== $flag) {
            $this->renderExceptions = $flag ? true : false;
        }

        return $this->renderExceptions;
    }

    /**
     * Send the response, including all headers, rendering exceptions if so
     * requested.
     *
     * @return void
     */
    public function send()
    {
        $this->sendHeaders();

        if ($this->isException() && $this->renderExceptions()) {
            $exceptions = '';
            foreach ($this->getException() as $e) { /** @var $e \Exception */
                $exceptions .= $e->__toString() . "\n";
            }
            echo $exceptions;
            return;
        }

        $this->outputBody();
    }

    /**
     * Magic __toString functionality
     *
     * Proxies to {@link sendResponse()} and returns response value as string
     * using output buffering.
     *
     * @return string
     */
    public function __toString()
    {
        ob_start();
        $this->send();
        return ob_get_clean();
    }
}
