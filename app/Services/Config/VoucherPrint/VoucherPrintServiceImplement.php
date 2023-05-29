<?php

namespace App\Services\Config\VoucherPrint;

use LaravelEasyRepository\Service;
use App\Repositories\Config\VoucherPrint\VoucherPrintRepository;

class VoucherPrintServiceImplement extends Service implements VoucherPrintService
{

    /**
     * don't change $this->mainRepository variable name
     * because used in extends service class
     */
    protected $mainRepository;

    public function __construct(VoucherPrintRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }

    // Define your custom methods :)
}
