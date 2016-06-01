<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class ImageController extends Controller {

    /**
     * Controller to save a new image.
     *
     * @param Request $request
     * @return mixed
     */
    public function create(Request $request) {
        $this->validate($request, [
            'project_id' => 'required|string',
            'display_name' => 'required|string',
            'file_name' => 'required|string'
        ]);

        $image = new Image();
        if($request->input('i_id') != '') {
            $image->i_id = $request->input('i_id');
        } else {
            $image->i_id = Uuid::uuid();
        }
        $image->project_id = $request->input('project_id');
        $image->display_name = $request->input('display_name');
        $image->file_name = $request->input('file_name');

        return response()->success($image->save());
    }

    /**
     * Controller to get a single image.
     *
     * @param $i_id
     * @return mixed
     */
    public function getSingle($i_id) {
        $image = Image::find($i_id);

        return response()->success(compact('image'));
    }

    /**
     * Controller to get all images.
     *
     * @return mixed
     */
    public function getList() {
        $images = Image::all();

        return response()->success(compact('images'));
    }

    /**
     * Controller to get projects matching a criteria.
     *
     * @return mixed
     */
    /*public function getList() {
        images = Project::all();

        return response()->success(compact('images'));
    }*/

    /**
     * Controller to edit a image.
     *
     * @param $i_id
     * @return mixed
     */
    public function update(Request $request, $i_id) {
        $this->validate($request, [
            'project_id' => 'required|string',
            'display_name' => 'required|string',
            'file_name' => 'required|string'
        ]);
        $image = Image::find($i_id);
        $image->project_id = $request->input('project_id');
        $image->display_name = $request->input('display_name');
        $image->file_name = $request->input('file_name');

        return response()->success($image->save());
    }

    /**
     * Controller to delete a image.
     *
     * @param $i_id
     * @return mixed
     */
    public function delete($i_id) {
        $image = Image::find($i_id);

        return response()->success($image->delete());
    }

}
