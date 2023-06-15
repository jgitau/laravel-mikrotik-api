<?php

namespace App\Repositories\MikrotikApi;

use LaravelEasyRepository\Repository;

interface MikrotikApiRepository extends Repository{

    /**
     * getMikrotikUserActive
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikUserActive($ip, $username, $password);

    /**
     * getMikrotikActiveHotspot
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikActiveHotspot($ip, $username, $password);

    /**
     * getMikrotikResourceData
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function getMikrotikResourceData($ip, $username, $password);

    /**
     * getTrafficData
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @param  mixed $interface
     * @return void
     */
    public function getTrafficData($ip, $username, $password, $interface);

    /**
     * getDhcpLeasesData
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @param  mixed $interface
     * @return void
     */
    public function getDhcpLeasesData($ip, $username, $password);

    /**
     * Retrieves DHCP Leases records from a database, initializes DataTables, adds columns to DataTable.
     * @return DataTables Yajra JSON response or null if there's no data.
     */
    public function getDhcpLeasesDatatables($ip, $username, $password);

    /**
     * connect
     * @param  mixed $ip
     * @param  mixed $username
     * @param  mixed $password
     * @return void
     */
    public function connect($ip, $username, $password);

}
