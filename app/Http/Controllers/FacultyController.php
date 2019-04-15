<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FacultyController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/faculties",
     *      operationId="getFacultiesList",
     *      tags={"faculties"},
     *      summary="Get list of faculties",
     *      description="Returns list of faculties",
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faculties = Faculty::all();
        return response()->json($faculties);
    }

    /**
     * @OA\Post(
     *      path="/api/faculties",
     *      operationId="createFaculty",
     *      tags={"faculties"},
     *      summary="Endpoint for creating a new faculty.",
     *      description="Create faculty",
     *      @OA\Parameter(
     *          name="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = [
            'name' => $request->name
        ];
        $rules = array(
            'name' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],422);
        }

        Faculty::create($data);
        return response()->json(['success' => 'Faculty created successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/faculties/{id}",
     *      operationId="getSingleFaculty",
     *      tags={"faculties"},
     *      summary="Get single faculty",
     *      description="Returns single faculty",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = Faculty::find($id);
        return response()->json($faculty);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @OA\Put(
     *      path="/api/faculties/{id}",
     *      operationId="UpdateSingleFaculty",
     *      tags={"faculties"},
     *      summary="Update single faculty",
     *      description="Endpoint for update single faculty",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->name,
        ];
        $rules = array(
            'name' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()],422);
        }

        Faculty::find($id)->update($data);
        return response()->json(['status' => 'Faculty updated successfully']);
    }

    /**
     * @OA\Delete(
     *      path="/api/faculties/{id}",
     *      operationId="deleteFaculty",
     *      tags={"faculties"},
     *      summary="Endpoint for deleting faculty.",
     *      description="Delete faculty",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Faculty::find($id)->delete();
        Group::where('faculty_id', $id)->delete();
        return response()->json(['status' => 'Faculty deleted successfully']);
    }
    /**
     * @OA\Get(
     *      path="/api/faculties/{id}/groups",
     *      operationId="getGroupsListOfFaculty",
     *      tags={"faculties"},
     *      summary="Get list of groups of faculty",
     *      description="Returns list of groups of faculty",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *       security={
     *           {"api_key_security_example": {}}
     *       }
     *     )
     *
     * @return \Illuminate\Http\Response
     */
    public function getGroups($id)
    {
        $groups = Group::where('faculty_id', $id)->get();
        return response()->json($groups);
    }

}
