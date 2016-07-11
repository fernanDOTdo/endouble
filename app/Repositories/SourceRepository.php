<?php

namespace App\Repositories;

use App\Source;
use Storage;

/**
 * Source Repository
 */

class SourceRepository implements SourceRepositoryInterface
{
    /**
     * Get All Enabled Data Sources
     *
     * @return array
     */
    public function getSources()
    {
        $sources = Cache::get('source.all', function() {
            $allSources = Source::all()->sortByAsc("priority");
            if($allSources){
                $classSources = [];
                foreach ($allSources as $source){
                    $classSources[] = 'App\\DataSources\\' . $source->name .'Source';
                }
                Cache::forever('source.all', json_encode($classSources));
                return json_encode($classSources);
            }
        });
        return json_decode($sources);
    }
    /**
     * Get a source by ID
     *
     * @param int
     * @return Source
     */
    public function get($source_id)
    {
        return Source::withoutGlobalScopes()->find($source_id);
    }

    /**
     * Get all sources
     *
     * @return mixed
     */
    public function all()
    {
        return Source::withoutGlobalScopes()->orderBy('priority', 'asc')->get();
    }

    /**
     * Refresh all sources
     *
     * @return bool
     */
    public function refresh()
    {
        // Reset the Sources table
        Source::truncate();
        // Get the DataSources full path
        $sources_path = app_path('DataSources');
        // Get the DataSources full namespace
        $sources_namespace = 'App\\DataSources\\';
        // Get all files in DataSources directory
        $sources = scandir($sources_path);
        // If we found some files in the folder
        if(is_array($sources)){
            // Loop trough the files
            foreach ($sources as $source){
                // If it's PHP file
                if(strpos($source, '.php') !== false){
                    // Initiate the Data Source class
                    $source_className = $sources_namespace.substr($source, 0, -4);
                    $source_class = new $source_className;
                    // If the class initiation was good
                    if(is_object($source_class)){
                        // Get the config data to insert in DB
                        $source_config = $source_class->getConfig();
                        // If the config data is there
                        if(is_array($source_config)){
                            // Save the Source
                            $this->save($source_config);
                        }
                    }
                }
            }
            return true;
        }
        return false;
    }

    /**
     * Update a source
     *
     * @param int
     * @param array
     */
    public function update($source_id, array $source_data)
    {
        // When the "enabled" checkbox is unchecked, nothing is sent to the server
        // So we have to set it as false
        if(!isset($source_data['enabled'])){
            $source_data['enabled'] = false;
        }
        // Update the Data Source in DB
        Source::withoutGlobalScopes()->find($source_id)->update($source_data);
    }

    /**
     * Save a source
     *
     * @param array
     */
    public function save(array $source_data)
    {
        $source = new Source();
        foreach ($source_data as $k => $v) $source->$k = $v;
        $source->save();
    }
}