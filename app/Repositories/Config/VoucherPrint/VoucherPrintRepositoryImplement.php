<?php

namespace App\Repositories\Config\VoucherPrint;

use LaravelEasyRepository\Implementations\Eloquent;
use App\Models\Voucher;

class VoucherPrintRepositoryImplement extends Eloquent implements VoucherPrintRepository{

    /**
    * Model class to be used in this repository for the common methods inside Eloquent
    * Don't remove or change $this->model variable name
    * @property Model|mixed $model;
    */
    protected $model;

    public function __construct(Voucher $model)
    {
        $this->model = $model;
    }

    // Write something awesome :)
}
