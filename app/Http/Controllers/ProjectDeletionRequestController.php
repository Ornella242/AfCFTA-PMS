<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectDeletionRequest;
use App\Models\Project;

class ProjectDeletionRequestController extends Controller
{
    public function index()
    {
        $requests = ProjectDeletionRequest::with('project', 'requester')->latest()->get();
        return view('admin.deletion_requests', compact('requests'));
    }

    public function approve($id)
    {
        $request = ProjectDeletionRequest::findOrFail($id);
        $project = $request->project;

        // Marquer la demande comme approuvée
        $request->approved = true;
        $request->save();

        // Mettre à jour le statut du projet à "Cancelled"
        $project->previous_status = $project->status;
        $project->status = 'Cancelled';
        $project->save();

        return back()->with('success', 'Project marked as Cancelled after approval.');
    }


    public function decline($id)
    {
        $request = ProjectDeletionRequest::findOrFail($id);
        $request->delete(); // Or mark as declined with a status
        return back()->with('info', 'Deletion request declined.');
    }

}
