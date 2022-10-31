<?php

namespace Usmonaliyev\LaravelTelegramNotifier\Utils;

class ErrorMessageBuilder
{
    /**
     * Gets the Exception code
     *
     * Example: https://www.php.net/manual/en/exception.getcode.php
     */
    const GET_CODE = "getCode";

    /**
     * Gets the stack trace
     * I don't recommend this section to add context because trace is very large array.
     *
     * Example: https://www.php.net/manual/en/exception.gettrace.php
     */
    const GET_TRACE = "getTrace";


    /**
     * Returns the Exception message as a string.
     *
     * Example: https://www.php.net/manual/en/exception.gettraceasstring.php
     */
    const GET_TRACE_AS_STING = "getTraceAsString";


    /**
     * Returns the Exception message as a string.
     *
     * Example: https://www.php.net/manual/en/exception.getmessage.php
     */
    const GET_MESSAGE = "getMessage";

    /**
     * Gets the file in which the exception was created
     *
     * Example: https://www.php.net/manual/en/exception.getfile.php
     */
    const GET_FILE = "getFile";

    /**
     * Gets the line in which the exception was created
     *
     * Example: https://www.php.net/manual/en/exception.getline.php
     */
    const GET_LINE = "getLine";

    /**
     * String representation of the exception
     *
     * Example: https://www.php.net/manual/en/exception.tostring.php
     */
    const __TO_STRING = "__toString";
}
