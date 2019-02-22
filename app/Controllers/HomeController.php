<?php 
/**
 * PHP Version 7
 * 
 * @category Controller
 * @package  App\Controllers
 * @author   Hendro Pramana Sinaga <hendro@email.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://url.com
 */

namespace App\Controllers;
use App\Controllers\Controller;
use App\Models\Home;

/**
 * HomeController Class;
 * 
 * @category Controller
 * @package  App\Controllers
 * @author   Hendro Pramana Sinaga <hendro@email.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://url.com
 */
class HomeController extends Controller
{
    private $model;

    function __construct()
    {
        $this->model = new Home();
    }

    /**
     * @param $nama
     * @param $kode
     * @return bool|null
     */
    public function insertData($nama, $jumlah)
    {
        return $this->model->insertData($nama, $jumlah);
    }

    public function getData()
    {
        return $this->model->getData();
    }

    public function deleteData($id) {
         $this->model->deleteData($id);
    }

    public function updateData($nama, $jumlah, $id)
    {
        return $this->model->update($nama, $jumlah, $id);
    }
}