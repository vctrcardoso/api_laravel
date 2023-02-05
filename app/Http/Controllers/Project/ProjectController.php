<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index(): JsonResponse
    {
        $projects = Project::with('users:id,name')->get();

        return response()->json([
            'status' => 'success',
            'projects' => $projects
        ]);
    }

    public function show($id): JsonResponse
    {
        $project = Project::with('users:id,name')->findOrFail($id);

        return response()->json([
            'status' => 'success',
            'project' => $project
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $project = Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => Auth::user()->getAuthIdentifier()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Project created successfully',
            'project' => $project
        ]);

    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string',
            'description' => 'required|string'
        ]);

        $project = Project::all();
        $project = $project->find($id);

        $project->name = $request->name;
        $project->description = $request->description;
        $project->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Project updated successfully',
            'project' => $project
        ]);
    }

    public function destroy($id)
    {
        $project = Project::all();
        $project->where('user_id', 2)->find($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Project deleted successfully'
        ]);
    }

    public function listProjectUser(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'project' => Project::all()->where('user_id', Auth::user()->getAuthIdentifier())
        ]);
    }
}
