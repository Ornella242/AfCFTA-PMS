<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectDeletionRequest;
use App\Models\Project;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Mail\DeletionRequestDeclined;

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


    // public function decline($id)
    // {
    //     $request = ProjectDeletionRequest::findOrFail($id);
    //     $request->delete(); // Or mark as declined with a status
    //     return back()->with('info', 'Deletion request declined.');
    // }

    public function decline(Request $request, $id)
    {
        $request->validate([
            'decline_reason' => 'required|string|max:1000',
        ]);

        $dr = \App\Models\ProjectDeletionRequest::with(['requester','project'])->findOrFail($id);

        $dr->update([
            'approved' => 0, // boolean
            'decline_reason' => $request->decline_reason,
        ]);

        // Envoi de l’email au requester
        Mail::to($dr->requester->email)
            ->send(new DeletionRequestDeclined($dr, $request->decline_reason));

        return back()->with('success', 'Deletion request declined and requester notified.');
    }


}
