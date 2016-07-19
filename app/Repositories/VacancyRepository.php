<?php

namespace App\Repositories;

use App\Vacancy;
use App\DataSources\DefaultSource;

/**
 * Vacancy Repository.
 */
class VacancyRepository implements VacancyRepositoryInterface
{
    /**
     * We will store the Current Source for debug purposes.
     *
     * @var string
     */
    protected $current_source;

    /**
     * We will keep all the enabled Data Sources in this array.
     *
     * @var array
     */
    protected $sources = [];

    /**
     * SourceController constructor.
     *
     * @param SourceRepositoryInterface $source
     */
    public function __construct(SourceRepositoryInterface $source)
    {
        // The Data Sources sorted by the "priority" column
        $this->sources = $source->getSources();
    }

    /**
     * SourceController constructor.
     *
     * @return string|null
     */
    public function source()
    {
        return $this->current_source;
    }

    /**
     * Get a vacancy by ID.
     *
     * @param int
     *
     * @return Vacancy|false
     */
    public function get($vacancy_id)
    {
        // Let's try to get that Vacancy in the available Data Sources
        foreach ($this->sources as $source) {
            $source_class = new $source();
            if ($vacancy = $source_class->get($vacancy_id)) {
                // Store the Current Data Source
                $this->current_source = $source_class->getConfig()['name'];

                return $vacancy;
            }
        }

        return false;
    }

    /**
     * Get all vacancies.
     *
     * @return Vacancy|false
     */
    public function all()
    {
        /*
         *
         * The Data Sources doesn't work as a decentralized point
         * They are more like "data replicators" to improve the App's performance and
         * all the Data Sources "all" methods have a fallback to the Main DB.
         * So we can trust in the first Data Source who responds to the "all" method.
         *
         */
        foreach ($this->sources as $source) {
            $source_class = new $source();
            if ($vacancy = $source_class->all()) {
                // Store the Current Data Source
                $this->current_source = $source_class->getConfig()['name'];

                return $vacancy;
            } else {
            }
        }

        return false;
    }

    /**
     * Delete a vacancy.
     *
     * @param int
     */
    public function delete($vacancy_id)
    {
        foreach ($this->sources as $source) {
            $source_class = new $source();
            $source_class->delete($vacancy_id);
        }
    }

    /**
     * Update a vacancy.
     *
     * @param int
     * @param array
     */
    public function update($vacancy_id, array $vacancy_data)
    {
        foreach ($this->sources as $source) {
            $source_class = new $source();
            $source_class->update($vacancy_id, $vacancy_data);
        }
    }

    /**
     * Save a vacancy.
     *
     * @param array
     */
    public function save(array $vacancy_data)
    {
        // First we save in the main DB
        $default_source = new DefaultSource();
        $vacancy = $default_source->save($vacancy_data);
        if ($vacancy) {
            // Set the ID to help the other Data Sources
            $vacancy_data['id'] = $vacancy->id;
            // Now we'll save in all other Data Sources
            foreach ($this->sources as $source) {
                if ($source != 'App\DataSources\DefaultSource') {
                    $source_class = new $source();
                    $source_class->save($vacancy_data);
                }
            }
        }
    }

    /**
     * Search for a vacancy.
     *
     * @param int
     *
     * @return array
     */
    public function search($query)
    {
        // If the Data Source is not supposed to search, it'll return false
        // So we'll keep the first Data Source who responds to that method
        foreach ($this->sources as $source) {
            $source_class = new $source();
            if ($search = $source_class->search($query)) {
                // Store the Current Data Source
                $this->current_source = $source_class->getConfig()['name'];

                return $search;
            }
        }

        return array();
    }
}
