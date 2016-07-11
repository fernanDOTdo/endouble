<?php

namespace App\Http\Controllers;

use App\Source;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\SourceRepositoryInterface;

/**
 * Class SourceController
 * @package App\Http\Controllers
 */
class SourceController extends Controller
{
    protected $source;

    /**
     * SourceController constructor
     *
     * @param SourceRepositoryInterface $source
     */
    public function __construct(SourceRepositoryInterface $source)
    {
        $this->source = $source;
    }

    /**
     * List all sources
     *
     * @return mixed
     */
    public function index()
    {
        // Get all Sources in DB
        $sources = $this->source->all();
        // If it's empty, lets run the refresh
        if($sources->isEmpty()){
            $this->source->refresh();
            // Try to get all Sources again
            $sources = $this->source->all();
        }
        $data = [
            'sources' => $sources
        ];
        return view('sources.index', $data);
    }

    /**
     * Edit the Source
     *
     * @param  int  $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id)
    {
        return view('sources.edit', ['source' => $this->source->get($id)]);
    }

    /**
     * Update the specified Source
     *
     * @param  Request  $request
     * @param  int  $id
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->source->update($id, $request->all());
        return redirect('/sources')->with('success', 'Data Source Updated');
    }

    /**
     * Refresh the Sources From Disk
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function refresh()
    {
        $this->source->refresh();
        return redirect('/sources')->with('success', 'Data Sources Reloaded');
    }
}
