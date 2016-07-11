<?php

namespace App\DataSources;

use App\Vacancy;
use App\Repositories\VacancyRepositoryInterface;
use Cache;

/**
 * Class ApcSource
 *
 * This is a sample Data Source that only implements the search
 *
 * @package App\DataSources
 */

class ApcSource implements VacancyRepositoryInterface
{
    /**
     * Default Data Source Info
     * @var array
     */
    protected $config = [
        'name' => 'Apc',
        'description' => 'APC Data Source',
        'priority' => 2,
        'enabled' => false
    ];

    /**
     * Get the Data Source Config Info
     *
     * @return array
     */
    public function getConfig(){
        return $this->config;
    }


    /**
     * Methods not implemented on this Data Source
     */
    public function get($vacancy_id)
    {
        // Not used on this Data Source
        return false;
    }
    public function all()
    {
        return false;
    }
    public function delete($vacancy_id){}
    public function update($vacancy_id, array $vacancy_data){}
    public function save(array $vacancy_data){}

    /**
     * Search for a vacancy
     *
     * @param int
     * @return mixed
     */
    public function search($query)
    {
        return Cache::store('apc')->remember('search.'.md5($query), 30, function() use ($query) {
            return Vacancy::where('title', 'LIKE', '%'.$query.'%')
                ->orWhere('content', 'LIKE', '%'.$query.'%')
                ->orWhere('description', 'LIKE', '%'.$query.'%')
                ->get();
        });
    }
}