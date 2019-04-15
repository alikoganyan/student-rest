<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/groups",
     *      operationId="getGroupsList",
     *      tags={"groups"},
     *      summary="Get list of groups",
     *      description="Returns list of groups",
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
        $groups = Group::with('get_faculty')->get();
        return response()->json($groups);
    }

    /**
     * @OA\Post(
     *      path="/api/groups",
     *      operationId="createGroup",
     *      tags={"groups"},
     *      summary="Endpoint for creating a new group.",
     *      description="Create group",
     *      @OA\Parameter(
     *          name="name",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="faculty_id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
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
            'faculty_id' => $request->faculty_id,
            'name' => $request->name,
        ];
        $rules = array(
            'faculty_id' => 'required|numeric',
            'name' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors()],422);
        }

        Group::create($data);
        return response()->json(['success'=>'Group created successfully']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @OA\Get(
     *      path="/api/groups/{id}",
     *      operationId="getSingleGroup",
     *      tags={"groups"},
     *      summary="Get single group",
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
        $group = Group::with('get_faculty')->where('id',$id)->first();    //find($id)
        return response()->json($group);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * @OA\Put(
     *      path="/api/groups/{id}",
     *      operationId="UpdateSingleGroup",
     *      tags={"groups"},
     *      summary="Update single group",
     *      description="Endpoint for update single group",
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
     *     @OA\Parameter(
     *          name="faculty_id",
     *          required=true,
     *          in="query",
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
    public function update(Request $request, $id)
    {
        $data = [
            'faculty_id' => $request->faculty_id,
            'name'=> $request->name,
        ];
        $rules = array(
            'faculty_id' => 'required|numeric',
            'name' => 'required',
        );

        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(['error'=> $validator->errors(),422]);
        }

        Group::find($id)->update($data);
        return response()->json(['status' => 'Group updated successfully']);
    }

    /**
     * @OA\Delete(
     *      path="/api/groups/{id}",
     *      operationId="deleteGroup",
     *      tags={"groups"},
     *      summary="Endpoint for deleting group.",
     *      description="Delete group",
     *      @OA\Parameter(
     *          name="id",
     *          required=true,
     *          in="path",
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
    public function destroy($id)
    {
        Group::find($id)->delete();
        return response()->json(['status' => 'Group deleted successfully']);
    }
}
