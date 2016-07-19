<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\VacancyRepositoryInterface;

/**
 * Class VacancyController.
 */
class VacancyController extends Controller
{
    protected $vacancy;

    /**
     * SourceController constructor.
     *
     * @param VacancyRepositoryInterface $vacancy
     */
    public function __construct(VacancyRepositoryInterface $vacancy)
    {
        $this->vacancy = $vacancy;
    }

    /**
     * List all vacancies.
     *
     * @return mixed
     */
    public function index()
    {
        // Get all Vacancies in DB
        $vacancies = $this->vacancy->all();
        $data = [
            'vacancies' => $vacancies,
            'source' => $this->vacancy->source(),
        ];

        return view('vacancies.index', $data);
    }

    /**
     * Edit the Vacancy.
     *
     * @param int $id
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit($id)
    {
        return view('vacancies.edit', ['vacancy' => $this->vacancy->get($id), 'source' => $this->vacancy->source()]);
    }

    /**
     * Update the specified Vacancy.
     *
     * @param Request $request
     * @param int     $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $this->vacancy->update($id, $request->all());

        return redirect('/vacancies')->with('success', 'Vacancy Updated');
    }

    /**
     * Show the form for creating a new Vacancy.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create()
    {
        return view('vacancies.create');
    }

    /**
     * Store a newly created Vacancy.
     *
     * @param Request $request
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->vacancy->save($request->all());

        return redirect('/vacancies')->with('success', 'Vacancy Created');
    }

    /**
     * Delete the specified Vacancy.
     *
     * @param int $id
     *
     * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->vacancy->delete($id);

        return redirect('/vacancies')->with('success', 'Vacancy Deleted');
    }

    /**
     * Search Vacancies.
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function search(Request $request)
    {
        $query = $request->get('q');
        if (empty($query)) {
            return redirect('/vacancies')->with('error', 'Please Type Something');
        }
        $vacancies = $this->vacancy->search($query);
        $data = [
            'vacancies' => $vacancies,
            'source' => $this->vacancy->source(),
            'query' => $query,
        ];

        return view('vacancies.search', $data);
    }
}
