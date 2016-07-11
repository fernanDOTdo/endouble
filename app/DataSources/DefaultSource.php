<?php

namespace App\DataSources;

use App\Vacancy;
use App\Repositories\VacancyRepositoryInterface;

/**
 * Default Source
 */

class DefaultSource implements VacancyRepositoryInterface
{
    /**
     * Default Data Source Info
     * @var array
     */
    protected $config = [
        'name' => 'Default',
        'description' => 'Default Data Source',
        'priority' => 100,
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
        return Vacancy::find($vacancy_id);
    }

    /**
     * Get all vacancies
     *
     * @return mixed
     */
    public function all()
    {
        return Vacancy::all();
    }

    /**
     * Delete a vacancy
     *
     * @param int
     */
    public function delete($vacancy_id)
    {
        Vacancy::destroy($vacancy_id);
    }

    /**
     * Update a vacancy
     *
     * @param int
     * @param array
     */
    public function update($vacancy_id, array $vacancy_data)
    {
        Vacancy::find($vacancy_id)->update($vacancy_data);
    }

    /**
     * Search for a vacancy
     *
     * @param int
     * @param mixed
     */
    public function search($query)
    {
        Vacancy::where('title', 'LIKE', '%'.$query.'%')
        ->orWhere('content', 'LIKE', '%'.$query.'%')
        ->orWhere('description', 'LIKE', '%'.$query.'%')
        ->get();
    }

    /**
     * Save a vacancy
     *
     * @param array
     */
    public function save(array $vacancy_data)
    {
        $vacancy = new Vacancy();
        foreach ($vacancy_data as $k => $v) $vacancy->$k = $v;
        $vacancy->save();
    }

}