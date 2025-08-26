<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TaskArchivationRequest;
use App\Models\Task;
use App\Models\User;
use App\Mail\TaskArchiveDeclined;
use Illuminate\Support\Facades\Mail;

class TaskArchiveRequestController extends Controller
{
     public function index()
    {
        $requests = TaskArchivationRequest::with('task', 'requester')->latest()->get();
        return view('admin.task_archive_requests', compact('requests'));
    }

    public function approve($id)
    {
        $request = TaskArchivationRequest::findOrFail($id);
        $task = $request->task;

        // Marquer la demande comme approuvée
        $request->approved = true;
        $request->save();

        // Archiver la tâche
        $task->is_archived = true;
        $task->save();

        return back()->with('success', 'Task archived after approval.');
    }

   
    public function decline(Request $request, $id)
    {
        $archiveRequest = TaskArchivationRequest::findOrFail($id);

        $declineReason = $request->decline_reason;

        // Envoi de l'email
        Mail::to($archiveRequest->requester->email)->send(
            new TaskArchiveDeclined($archiveRequest, $declineReason)
        );

        // Suppression ou marquage comme décliné
        $archiveRequest->delete();

        return redirect()->back()->with('success', 'Archivation request declined successfully.');
    }


}
