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
use App\Models\BaseModel;

/**
 * Model Class
 * 
 * @category Model
 * @package  App\Models
 * @author   Hendro Pramana Sinaga <hendro@email.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://url.com
 */
class Home extends BaseModel
{
    /**
     * Modal Construction
     */
    public function __construct()
    {
        parent::__construct();
        $this->createTable();
    }

    private function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS `perangkat` (
                  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
                  `nama` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
                  `jumlah` int NOT NULL,
                   PRIMARY KEY (`id`) 
                )ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();
                $this->conn->commit();
            } catch (\Exception $exception) {
                $this->conn->rollBack();
                return $exception->getMessage();
            }
        }
    }

    /**
     * @param $nama
     * @param $kode
     * @return bool|null
     */
    public function insertData($nama, $jumlah)
    {
        $sql = "INSERT INTO perangkat (id, nama, jumlah) 
                VALUES (?, ?, ?)";
        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt= $this->conn->prepare($sql);
                $dt = new \DateTime('now');
                $stmt->execute([null, $nama, $jumlah]);
                $result = $this->conn->commit();
            } catch (\Exception $e) {
                $result = false;
                $this->conn->rollBack();
            }
            return $result;
        } else {
            return null;
        }
    }

    public function update($nama, $jumlah, $id) {
        $sql = "UPDATE perangkat SET nama = ?, jumlah = ? WHERE id = ?";
        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt= $this->conn->prepare($sql);
                $stmt->execute([$nama, $jumlah, $id]);
                $result = $this->conn->commit();
            } catch (\Exception $e) {
                $result = false;
                $this->conn->rollBack();
            }
            return $result;
        } else {
            return null;
        }
    }

    /**
     * @return bool|null
     */
    public function changeJumlahPerangkat()
    {
        $sql = "UPDATE perangkat SET jumlah = 9 WHERE id = 3 AND jumlah = 8";
        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt= $this->conn->prepare($sql);
                $stmt->execute();
                $result = $this->conn->commit();
            } catch (\Exception $e) {
                $result = false;
                $this->conn->rollBack();
            }
            return $result;
        } else {
            return null;
        }
    }

    public function getData()
    {
        $sql = "SELECT * FROM perangkat";
        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt= $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            } catch (\Exception $e) {
                $result = false;
                $this->conn->rollBack();
            }
            return $result;
        } else {
            return null;
        }
    }

    public function deleteData($id) {
        $sql = "DELETE FROM perangkat WHERE id = ?";
        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt= $this->conn->prepare($sql);
                $stmt->execute([$id]);
                $result = $this->conn->commit();
            } catch (\Exception $e) {
                $result = false;
                $this->conn->rollBack();
            }
            return $result;
        } else {
            return null;
        }
    }

    /**
     * @return array|bool|null
     */
    public function showOP()
    {
        $sql = "SELECT * FROM perangkat WHERE nama LIKE '%op%'";
        if ($this->connect()) {
            try {
                $this->conn->beginTransaction();
                $stmt= $this->conn->prepare($sql);
                $stmt->execute();
                $result = $stmt->fetchAll(\PDO::FETCH_OBJ);
            } catch (\Exception $e) {
                $result = false;
                $this->conn->rollBack();
            }
            return $result;
        } else {
            return null;
        }
    }

}