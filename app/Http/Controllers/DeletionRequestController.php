<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DeletionRequest;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;


class DeletionRequestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required|exists:projects,id',
            'reason' => 'required|string|max:1000',
        ]);

        DeletionRequest::create([
            'project_id' => $request->project_id,
            'requester_id' => Auth::id(),
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Deletion request submitted and waiting for admin approval.');
    }

    public function decline(Request $request, $id)
    {
        $deletionRequest = DeletionRequest::findOrFail($id);

        // Raison saisie dans le modal
        $reason = $request->input('decline_reason');

        // Exemple : tu peux enregistrer la raison du refus
        $deletionRequest->status = 'declined';
        $deletionRequest->decline_reason = $reason;
        $deletionRequest->save();

        // Envoi de l'email
        Mail::to($deletionRequest->requester->email)->send(
            new \App\Mail\DeletionRequestDeclined($deletionRequest, $reason)
        );

            return redirect()->back()->with('success', 'Deletion request declined and requester notified.');
        }

}
