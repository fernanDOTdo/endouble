<?php

namespace App\Repositories;

use App\Vacancy;

/**
 * Vacancy Repository
 */

class VacancyRepository implements VacancyRepositoryInterface
{
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
}