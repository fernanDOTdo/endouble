<?php

namespace App\Repositories;

/**
 * Interface VacancyRepository
 */
interface VacancyRepositoryInterface
{
    /**
     * Get a vacancy by ID
     *
     * @param int
     */
    public function get($vacancy_id);

    /**
     * Get all vacancies
     *
     * @return mixed
     */
    public function all();

    /**
     * Delete a vacancy
     *
     * @param int
     */
    public function delete($vacancy_id);

    /**
     * Update a vacancy
     *
     * @param int
     * @param array
     */
    public function update($vacancy_id, array $vacancy_data);

    /**
     * Save a vacancy
     *
     * @param array
     */
    public function save(array $vacancy_data);

    /**
     * Search for a vacancy
     *
     * @param int
     * @return array
     */
    public function search($query);
}