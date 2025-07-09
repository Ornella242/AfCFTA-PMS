<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DevelopmentDetail;

class DevelopmentDetailController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        $detail = DevelopmentDetail::findOrFail($id);
        $project = $detail->project;
        $status = $request->input('status');

        // Récupérer la sous-phase "development"
        $developmentSubphase = $project->subphases()->where('name', 'development')->first();

        if (!$developmentSubphase) {
            return redirect()->back()->with('error', 'Development subphase not found.');
        }

        // 🔒 Vérification : si on veut passer l'activité à "Completed", vérifier que les sous-phases précédentes sont "Completed"
        if ($status === 'Completed') {
            $allSubphases = $project->subphases()->orderBy('id')->get();

            $currentIndex = $allSubphases->search(function ($item) use ($developmentSubphase) {
                return $item->id == $developmentSubphase->id;
            });

            $previousNotCompleted = $allSubphases->take($currentIndex)->first(function ($sp) {
                return $sp->pivot->status !== 'Completed';
            });

            if ($previousNotCompleted) {
                $prevPhase = \App\Models\Phase::find($previousNotCompleted->phase_id);
                $prevPhaseName = $prevPhase->label ?? ucfirst($prevPhase->name);
                $prevSubName = $previousNotCompleted->label ?? $previousNotCompleted->name;
                $prevStatus = $previousNotCompleted->pivot->status;

                return redirect()->back()->with('error', "You cannot complete this development activity because previous subphase \"$prevSubName\" in phase \"$prevPhaseName\" is still \"$prevStatus\".");
            }
        }

        // ✅ Enregistrement du statut
        $detail->status = $status;
        $detail->reason = $request->input('reason');
        $detail->save();

        // Reste du code : recalcul du % de la sous-phase development
        $defaultPercentage = $developmentSubphase->default_percentage;
        $totalActivities = $project->developmentDetails()->count();

        $completed = 0;
        $inProgress = false;

        foreach ($project->developmentDetails as $activity) {
            if ($activity->status === 'Completed') {
                $completed++;
            } elseif ($activity->status === 'In progress') {
                $inProgress = true;
            }
        }

        // Calcul du pourcentage de la sous-phase
        $achieved = 0;
        if ($totalActivities > 0) {
            $perActivity = $defaultPercentage / $totalActivities;
            $achieved = $completed * $perActivity;

            if ($inProgress) {
                $achieved += $perActivity / 2;
            }
        }

        // Déterminer le statut global de la sous-phase
        $subphaseStatus = 'Not started';
        if ($completed === $totalActivities) {
            $subphaseStatus = 'Completed';
        } elseif ($inProgress || $completed > 0) {
            $subphaseStatus = 'In progress';
        }

        // Mise à jour de project_subphase
        $project->subphases()->updateExistingPivot($developmentSubphase->id, [
            'percentage' => round($achieved, 2),
            'status' => $subphaseStatus
        ]);

        // Recalcul de la phase "Implementation"
        $phaseId = $developmentSubphase->phase_id;
        $subphases = $project->subphases()->where('phase_id', $phaseId)->get();

        $totalDefault = $subphases->sum('default_percentage');
        $achievedPhase = 0;
        $allSubphasesCompleted = true;

        foreach ($subphases as $s) {
            $achievedPhase += ($s->pivot->percentage / 100) * $s->default_percentage;
            if ($s->pivot->status !== 'Completed') {
                $allSubphasesCompleted = false;
            }
        }

        $phasePercentage = $totalDefault > 0 ? round(($achievedPhase / $totalDefault) * 100, 2) : 0;

        $project->phases()->updateExistingPivot($phaseId, [
            'percentage' => $phasePercentage,
            'status' => $allSubphasesCompleted ? 'Completed' : 'In progress'
        ]);

        // ✅ Recalcul global du projet
        $allPhases = $project->phases()->with('subphases')->get();
        $totalProjectDefault = 0;
        $totalAchieved = 0;

        foreach ($allPhases as $phase) {
            $subs = $project->subphases()->where('phase_id', $phase->id)->get();
            $phaseDefault = $subs->sum('default_percentage');
            $phaseAchieved = 0;

            foreach ($subs as $s) {
                $phaseAchieved += ($s->pivot->percentage / 100) * $s->default_percentage;
            }

            $totalProjectDefault += $phaseDefault;
            $totalAchieved += $phaseAchieved;

            // Mettre à jour chaque phase aussi
            $individualPhasePercent = $phaseDefault > 0 ? round(($phaseAchieved / $phaseDefault) * 100, 2) : 0;
            $project->phases()->updateExistingPivot($phase->id, ['percentage' => $individualPhasePercent]);
        }

        $projectPercentage = $totalProjectDefault > 0 ? round(($totalAchieved / $totalProjectDefault) * 100, 2) : 0;
        $project->percentage = $projectPercentage;
        $project->save();

        return redirect()->back()->with('success', 'Development activity status and progress updated.');
    }


 public function store(Request $request)
{
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'development_activities' => 'required|array',
        'development_activities.*' => 'required|string|max:255',
    ]);

    // 🔍 Récupérer la sous-phase "development"
    $developmentSubphase = \App\Models\Subphase::where('name', 'development')->firstOrFail();

    // ✅ Créer les enregistrements
    foreach ($request->development_activities as $index => $title) {
        \App\Models\DevelopmentDetail::create([
            'project_id'   => $request->project_id,
            'subphase_id'  => $developmentSubphase->id,
            'title'        => $title,
            'status'       => 'Not started',
        ]);
    }

    return redirect()->back()->with('success', 'Development activities added successfully.');
}



public function update(Request $request, $id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'status' => 'required|string',
        'reason' => 'nullable|string',
    ]);

    $detail = \App\Models\DevelopmentDetail::findOrFail($id);
    $detail->update([
        'title' => $request->title,
        'status' => $request->status,
        'reason' => $request->reason,
    ]);

    return redirect()->back()->with('success', 'Activity updated.');
}

public function destroy($id)
{
    \App\Models\DevelopmentDetail::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Activity deleted.');
}



}
