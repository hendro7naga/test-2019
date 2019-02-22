<?php 
/**
 * PHP version 7
 * 
 * @category Controller
 * @package  App\Controllers
 * @author   Hendro Pramana Sinaga <hendro@email.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://url.com
 */
namespace App\Controllers;
/**
 * Controller Class
 * 
 * @category Controller
 * @package  App\Controllers
 * @author   Hendro Pramana Sinaga <hendro@email.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://url.com
 */
class Controller
{
    /**
     * Get Request URI
     * 
     * @return string
     */
    public function requestUri()
    {
        return $_SERVER['REQUEST_URI'];
    }
    
    /**
     * Get Request Method
     * 
     * @return string
     */
    public function requestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Get Query String
     * 
     * @return string
     */
    public function queryString()
    {
        return $_SERVER['QUERY_STRING'];
    }
}
?>