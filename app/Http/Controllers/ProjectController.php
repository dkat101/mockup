<?php

namespace App\Http\Controllers;

use App\Project;
use Faker\Provider\Uuid;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProjectController extends Controller {

    /**
     * Controller to create a new project.
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $project = new Project();
        if($request->input('p_id') != '') {
            $project->p_id = $request->input('p_id');
        } else {
            $project->p_id = Uuid::uuid();
        }
        $project->user_id = $request->input('user_id');
        $project->name = $request->input('name');
        $project->description = $request->input('description');

        return response()->success($project->save());
    }

    /**
     * Controller to get a single project.
     *
     * @param $p_id
     * @return mixed
     */
    public function getSingle($p_id) {
        $project = Project::find($p_id);

        return response()->success(compact('project'));
    }

    /**
     * Controller to get all projects.
     *
     * @return mixed
     */
    public function getList() {
        $projects = Project::all();

        return response()->success(compact('projects'));
    }

    /**
     * Controller to get projects matching a criteria.
     *
     * @return mixed
     */
    /*public function getList() {
        $projects = Project::all();

        return response()->success(compact('projects'));
    }*/

    /**
     * Controller to edit a project.
     *
     * @param $p_id
     * @return mixed
     */
    public function update(Request $request, $p_id) {
        $this->validate($request, [
            'user_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'required|string'
        ]);
        $project = Project::find($p_id);
        $project->user_id = $request->input('user_id');
        $project->name = $request->input('name');
        $project->description = $request->input('description');

        return response()->success($project->save());
    }

    /**
     * Controller to delete a project.
     *
     * @param $p_id
     * @return mixed
     */
    public function delete($p_id) {
        $project = Project::find($p_id);

        return response()->success($project->delete());
    }

}
