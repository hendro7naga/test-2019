<?php
/**
 * PHP version 7
 * 
 * @category Model
 * @package  App\Models
 * @author   Hendro Pramana Sinaga <hendro@email.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://url.com
 */
namespace App\Models;

class BaseModel
{
    protected $conn;
    protected $environment;
    protected $dsn;

    /**
     * BaseModel Construction
     * 
     * @return void
     */
    public function __construct()
    {
        try {
            $this->dsn = ENV['db']['driver'] . ':host=' . ENV['db']['host'] . 
                ';dbname=' . ENV['db']['database'];
            $this->conn = new \PDO(
                $this->dsn, 
                ENV['db']['username'], 
                ENV['db']['password']
            );
        } catch (\Exception $e) {
            print_r($e->getMessage());
        }
    }

    /**
     * Connect to Database
     * 
     * @return mixed|bool
     */
    public function connect()
    {
        try {
            if ($this->conn == null) {
                $this->conn = new \PDO(
                    $this->dsn, 
                    ENV['db']['username'], 
                    ENV['db']['password'],
                    [\PDO::ATTR_PERSISTENT => true]
                );
            }
        } catch (\Exception $e) {
            $this->closeConnection();
            return new \Exception('Error: ' . $e->getMessage());
        } 
        return true;
    }

    /**
     * Get Connection
     * 
     * @return mixed|\Exception|null
     */
    public function getConnection()
    {
        try {
            if ($this->conn == null) {
                $this->conn = new \PDO(
                    $this->dsn, 
                    ENV['db']['username'], 
                    ENV['db']['password']
                );
            }
        } catch (\Exception $e) {
            $this->closeConnection();
            return new \Exception('Error: ' . $e->getMessage());
        }
        return $this->conn;
    }

    /**
     * Close All Connection
     * 
     * @return void
     */
    public function closeConnection()
    {
        $this->conn = null;
    }
}