<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {
    /**
     * @var integer
     */
    protected $pageSize;

    /**
     * Controller constructor.
     */
    public function __construct () {
        $this->pageSize = env('PAGE_SIZE');
    }
}
