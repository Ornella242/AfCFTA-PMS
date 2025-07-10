<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    // public function store(Request $request)
    // {
    //     $project = Project::findOrFail($request->project_id);

    //     $report = new Report();
    //     $report->project_id = $project->id;
    //     $report->user_id = Auth::id(); // L'utilisateur qui génère le rapport
    //     $report->format = 'web';
    //     $report->generated_at = now();

    //     // Génération du code : #TYPE + ID
    //     $nextId = (Report::max('id') ?? 0) + 1;
    //     $report->code = '#' . strtoupper($project->type) . $nextId;
    //     $report->title = '#' . $project->title;

    //     $report->save();

    //     return redirect()->route('reports.show', $report->id);
    // }

    public function viewReport(Project $project)
    {
        // dd($project);
        // Vérifie si un rapport existe déjà aujourd'hui pour ce projet et cet utilisateur
        $existingReport = Report::where('project_id', $project->id)
            ->where('user_id', Auth::id())
            ->whereDate('generated_at', now()->toDateString())
            ->first();

            if (!$existingReport) {
            // Crée un nouveau rapport
            $report = new Report();
            $report->project_id = $project->id;
            $report->user_id = Auth::id();
            $report->format = 'web';
            $report->generated_at = now();
            $report->code = 'PENDING';
            $report->title = '#' . $project->title;
            $report->save();
            //  dd($report);
            // Génère un code unique : ex. #ADMIN12           
            $report->update([
                'code' => '#' . strtoupper($project->type) . $report->id,
            ]);
            // $report->save();
        } else {
            // Utilise le rapport existant
            $report = $existingReport;
        }

        return view('viewreport', compact('project', 'report'));
    }
}
