<?php

namespace App\DataSources;

use App\Vacancy;
use App\Repositories\VacancyRepositoryInterface;
use Cache;
use DB;

/**
 * Cache Source
 */

class CacheSource implements VacancyRepositoryInterface
{
    /**
     * Cache Data Source Info
     * @var array
     */
    protected $config = [
        'name' => 'Cache',
        'description' => 'Simple Cache Data Source',
        'priority' => 1,
        'enabled' => true
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
     * Get a vacancy by ID
     *
     * @param int
     * @return Vacancy
     */
    public function get($vacancy_id)
    {
        return Cache::store('file')->get('vacancy.'.$vacancy_id);
    }

    /**
     * Get all vacancies
     *
     * @return mixed
     */
    public function all()
    {
        // Get All the Vacancies from the Cache
        // (if it can't be found, store it in the Cache for 30 minutes)
        Cache::store('file')->remember('vacancies', 30, function() {
            return DB::table('vacancies')->get();
        });
    }

    /**
     * Delete a vacancy
     *
     * @param int
     */
    public function delete($vacancy_id)
    {
        Cache::store('file')->forget('vacancy.'.$vacancy_id);
    }

    /**
     * Update a vacancy
     *
     * @param int
     * @param array
     */
    public function update($vacancy_id, array $vacancy_data)
    {
        // First, remove the data from cache
        Cache::store('file')->forget('vacancy.'.$vacancy_id);
        // Get the Vacancy from the Cache
        // (if it can't be found, store it in the Cache for 30 minutes)
        Cache::store('file')->remember('vacancy.'.$vacancy_id, 30, function() use ($vacancy_id) {
            return Vacancy::find($vacancy_id);
        });
    }

    /**
     * Search for a vacancy
     *
     * @param int
     * @param mixed
     */
    public function search($query)
    {
        // Not used
    }

    /**
     * Save a vacancy
     *
     * @param array
     */
    public function save(array $vacancy_data)
    {
        // Only saves in the cache if we can find the id in $vacancy_data
        // (meaning that $vacancy_data was already saved in DB)
        if(isset($vacancy_data['id'])){
            Cache::store('file')->remember('vacancy.'.$vacancy_data['id'], 30, function() use ($vacancy_data) {
                return Vacancy::find($vacancy_data['id']);
            });
        }
    }

}