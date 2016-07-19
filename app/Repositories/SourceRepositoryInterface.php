<?php

namespace App\Repositories;

/**
 * Interface SourceRepository.
 */
interface SourceRepositoryInterface
{
    /**
     * Get All Enabled Data Sources.
     *
     * @return array
     */
    public function getSources();

    /**
     * Get a source by ID.
     *
     * @param int
     */
    public function get($source_id);

    /**
     * Get all sources.
     *
     * @return mixed
     */
    public function all();

    /**
     * Refresh all sources.
     *
     * @return bool
     */
    public function refresh();

    /**
     * Update a source.
     *
     * @param int
     * @param array
     */
    public function update($source_id, array $source_data);

    /**
     * Save a source.
     *
     * @param array
     */
    public function save(array $source_data);
}
