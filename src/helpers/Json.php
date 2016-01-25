<?php
/**
 * @link      http://craftcms.com/
 * @copyright Copyright (c) 2015 Pixel & Tonic, Inc.
 * @license   http://craftcms.com/license
 */

namespace craft\app\helpers;

use yii\base\InvalidParamException;

/**
 * Class Json
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class Json extends \yii\helpers\Json
{
    // Public Methods
    // =========================================================================

    /**
     * Decodes the given JSON string into a PHP data structure, only if the string is valid JSON.
     *
     * @param string  $str     The string to be decoded, if it's valid JSON.
     * @param boolean $asArray Whether to return objects in terms of associative arrays.
     *
     * @return mixed The PHP data, or the given string if it wasn’t valid JSON.
     */
    public static function encodeIfJson($str, $asArray = true)
    {
        try {
            return static::encode($str, $asArray);
        } catch (InvalidParamException $e) {
            // Wasn't JSON
            return $str;
        }
    }

    /**
     * Sets JSON helpers on the response.
     *
     * @return void
     */
    public static function sendJsonHeaders()
    {
        Header::setNoCache();
        Header::setContentTypeByExtension('json');
    }
}
