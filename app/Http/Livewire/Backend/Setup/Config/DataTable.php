<?php

namespace App\Http\Livewire\Backend\Setup\Config;

use App\Services\Config\ConfigService;
use Livewire\Component;

class DataTable extends Component
{
    public function render()
    {
        return view('livewire.backend.setup.config.data-table');
    }

    /**
     * getDataTable
     * @param  mixed $configService
     */
    public function getDataTable(ConfigService $configService)
    {
        return $configService->getDatatables();
    }
}
