<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Report;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReportShared;
use App\Models\User;

class ReportController extends Controller
{
   
    public function viewReport($encryptedId)
  {
    $id = decrypt($encryptedId);
    $project = Project::findOrFail($id);
      
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

    public function index()
    {
        $pmRoleId = \App\Models\Role::where('name', 'Project Manager')->value('id');
    $users = User::where('role_id', $pmRoleId)->get();
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Tous les rapports du mois courant
        $monthlyReports = Report::with('project')
                                ->whereMonth('created_at', $currentMonth)
                                ->whereYear('created_at', $currentYear)
                                ->get();
       
        // Rapports HRM du mois courant
        $hrmReports = $monthlyReports->filter(function ($report) {
            return str_starts_with($report->code, '#HRM');
        });

        // Rapports Admin du mois courant
        $adminReports = $monthlyReports->filter(function ($report) {
            return str_starts_with($report->code, '#ADMIN');
        });

        $projects = Project::all();
        return view('reports', compact('monthlyReports', 'hrmReports', 'adminReports', 'projects','users'));
    }

    public function download(Report $report)
    {
        $project = $report->project;

        // Prépare les données à afficher dans le PDF
        $pdf = Pdf::loadView('viewreport_pdf', compact('project', 'report'))
        ->setPaper('a4', 'portrait');

        $filename = $report->code . '.pdf';
    //  return view('viewreport_pdf', compact('project', 'report'));
        return $pdf->download($filename);
    }

  public function share(Request $request, Report $report)
    {
        // dd('hi');
        $request->validate([
            'users' => 'required|array',
        ]);

        $users = User::whereIn('id', $request->users)->get();
        // dd($users);
        foreach ($users as $user) {
            Mail::to($user->email)->send(new ReportShared($report, $user));
        }

        return redirect()->back()->with('success', 'Report shared successfully!');
    }

}
