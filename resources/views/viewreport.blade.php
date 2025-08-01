@php
    $isPdf = request()->routeIs('reports.download');
@endphp



@include('partials.navbar')
<style>
    @media print {
          .table-responsive,
    table {
        width: 100% !important;
    }

        body * {
            visibility: hidden;
        }
        @page {
            size: A4;
            /* Supprime toutes les marges */
            margin: 0 !important; 
        }
        #print-section, #print-section * {
            visibility: visible;
        }

        #print-section {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        /* Afficher les progress bars */
        .progress {
            background-color: #e9ecef !important;
            border-radius: 20px !important;
            height: 10px !important;
        }

        .progress-bar {
            height: 100% !important;
        }

        /* Afficher les couleurs de badges et progress bars */
        .bg-success { background-color: #28a745 !important; color: white !important; }
        .bg-warning { background-color: #ffc107 !important; color: black !important; }
        .bg-danger  { background-color: #dc3545 !important; color: white !important; }
        .bg-info    { background-color: #17a2b8 !important; color: white !important; }
        .bg-gold-light { background-color: #f5f0e1 !important; }
        .text-black { color: #000 !important; }
        .text-maroon { color: #800000 !important; }

        /* Restaurer les bordures HR */
        hr {
            display: block !important;
            border: none;
            height: 3px;
            background: linear-gradient(to right, #1b1311, #feb47b);
            margin: 1rem 0;
        }

        /* Cacher le bouton d'impression lui-même */
        .no-print {
            display: none !important;
        }

         .final-comment-section {
        page-break-inside: avoid;
        margin-top: 50px !important;
    }

    .final-comment-section table,
    .final-comment-section th,
    .final-comment-section td {
        border: 1px solid #000 !important;
    }
    }
</style>
<main role="main" class="main-content">
                        <div class="container-fluid">
                            <div class="row justify-content-center">
                                <div class="col-12">
                                    <div class="row align-items-center mb-4">
                                        <div class="col">
                                        <h2 class="h3 page-title text-black">
                                            <small class="h3 text-maroon text-uppercase">Report</small><br />
                                            {{ $report->code ?? '#0000' }}
                                        </h2>
                                        </div>
                                        <div class="col-auto">
                                        <button type="button" class="btn bg-yellow text-white no-print" onclick="printSection()"><i class="fe fe-printer fe-16"></i> Print</button>
                                        </div>
                                    </div>
                                    <div class="card shadow" id="print-section">
                                        <div class="card-body p-5">
                                            <div class="row align-items-center">
                                                <div class="col-md-10">
                                                    <h4 class="mb-1 text-uppercase">African Continental Free Trade Area Secretariat</h4>
                                                    <p class="mb-0">Creating One African Market</p>
                                                </div>
                                                <div class="col-md-2 text-right">
                                                    <img src="{{ asset('images/logo.png') }}" alt="AfCFTA Logo" class="navbar-brand-img brand-md mx-auto mb-4">
                                                </div>
                                                </div>
                                                <hr style="border-top: 3px solid #C2A756; margin-top: 0;">

                                            <div class="row mb-2">
                                            <div class="col-12 mb-2">
                                                <h3 class="mb-0  mt-2 text-uppercase">Report {{ $report->code ?? '#0000' }} | {{ $project->title }}</h3>
                                                {{-- <p class="text-black font-bold"> Generated {{ \Carbon\Carbon::parse($report->generated_at)->format('d/m/Y') }} <br />By {{ $report->user->firstname .' '. $report->user->lastname}} </p> --}}
                                            </div>
                                            </div> <!-- /.row -->
                                        
                                            <div class="">
                                                <div class="">
                                                    {{-- <h4 class="text-maroon mb-3"></h4> --}}
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered table-striped">
                                                            <tbody>
                                                                {{-- Objectif --}}
                                                                <tr>
                                                                    <th class="fw-bold text-black" style="width: 25%;">Objective</th>
                                                                    <td colspan="3" class="text-black">{{ $project->description }}</td>
                                                                </tr>

                                                                {{-- Dates --}}
                                                                <tr>
                                                                    <th class="text-black">Start Date </th>
                                                                    <td class="text-black">{{ \Carbon\Carbon::parse($project->start_date)->format('d M Y') }}</td>
                                                                    <th class="text-black">End Date</th>
                                                                    <td class="text-black">{{ \Carbon\Carbon::parse($project->end_date)->format('d M Y') }}</td>
                                                                </tr>

                                                                {{-- Budget & Code --}}
                                                                <tr>
                                                                    <th class="text-black">Budget</th>
                                                                    <td class="text-black">${{ number_format($project->budget, 2) }}</td>
                                                                    <th class="text-black">Budget Code</th>
                                                                    <td class="text-black">{{ $project->budget_code ?? 'N/A' }}</td>
                                                                </tr>

                                                                {{-- Project Manager --}}
                                                                <tr>
                                                                    <th class="text-black">Project Manager</th>
                                                                    <td colspan="3" class="text-black">{{ $project->manager?->name ?? 'N/A' }}</td>
                                                                </tr>

                                                                {{-- Partners --}}
                                                                <tr>
                                                                    <th class="text-black">Partners</th>
                                                                    <td colspan="3">
                                                                        @if($project->partners->isNotEmpty())
                                                                            <ul class="mb-0 ps-3 text-black">
                                                                                @foreach($project->partners as $partner)
                                                                                    <li>{{ $partner->name }}</li>
                                                                                @endforeach
                                                                            </ul>
                                                                        @else
                                                                            <span class="text-black">No partners assigned</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row my-4">
                                                <div class="col-md-12">
                                                    <div class="mb-1">
                                                        <div>
                                                        <strong class="card-title h4 text-black pt-2"><i class="fe fe-shield fe-24"></i> Executive Summary</strong>
                                                        </div>
                                                        <hr style="border: none; height: 3px; background: linear-gradient(to right, #1b1311, #feb47b);">

                                                        <div class="card-body">
                                                            @foreach($project->phases as $phase)
                                                                @php
                                                                    $label = $phase->label ?? ucfirst($phase->name);
                                                                    $percentage = $phase->pivot->percentage ?? 0;

                                                                    $colorClass = match(strtolower($phase->name)) {
                                                                        'implementation' => 'bg-success',
                                                                        'tor' => 'bg-info',
                                                                        'procurement' => 'bg-warning',
                                                                        default => ($percentage >= 80 ? 'bg-success' : ($percentage >= 50 ? 'bg-warning' : 'bg-danger')),
                                                                    };
                                                                @endphp

                                                                <div class="row align-items-center mb-3">
                                                                    {{-- Nom de la phase --}}
                                                                    <div class="col-4">
                                                                        <span class="fw-semibold text-black h6">{{ $label }}</span>
                                                                    </div>

                                                                    {{-- Barre de progression + % --}}
                                                                    <div class="col-8">
                                                                        <div class="d-flex justify-content-between mb-1">
                                                                            <span class="text-muted small">Progress</span>
                                                                            <span class="text-muted small">{{ $percentage }}%</span>
                                                                        </div>
                                                                        <div class="progress" style="height: 10px; border-radius: 20px;">
                                                                            <div class="progress-bar progress-bar-striped {{ $colorClass }}"
                                                                                role="progressbar"
                                                                                style="width: {{ $percentage }}%;"
                                                                                aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>


                                                    <div class="mb-2">
                                                        <div>
                                                            <strong class="card-title h4 text-black pt-1"><i class="fe fe-layers fe-24"></i> Administrative Report</strong>
                                                        </div>
                                                        <hr style="border: none; height: 3px; background: linear-gradient(to right, #feb47b, #1b1311);">
                                                    </div>
                                                    <div class="card-body p-3">
                                                    
                                                        <div class="row">
                                                            @foreach($project->phases as $phase)
                                                                <div class="col-md-{{ 12 / $project->phases->count() }} mb-4">
                                                                    <div class="rounded p-3 h-100" style="border: 3px solid #9E2140;">
                                                                        <h6 class="text-uppercase fw-bold text-maroon mb-3 text-center">
                                                                            {{ strtoupper($phase->label ?? $phase->name) }}
                                                                        </h6>

                                                                        @php
                                                                            $subphases = $project->subphases->where('phase_id', $phase->id);
                                                                        @endphp

                                                                        @if($subphases->isEmpty())
                                                                            <p class="text-muted fst-italic text-center">No subphases available.</p>
                                                                        @else
                                                                            <table class="table table-sm table-borderless mb-0">
                                                                                <tbody>
                                                                                    @foreach($subphases as $sub)
                                                                                        @php
                                                                                            $status = $sub->pivot->status ?? null;
                                                                                            $isAward = strtolower($sub->name) === 'award' && $status === 'Completed';

                                                                                            // Sous-phase Cancelled ou Delayed
                                                                                            $isSubphaseCancelledOrDelayed = in_array($status, ['Cancelled', 'Delayed']);

                                                                                            // Détails de développement annulés/retardés (uniquement pour la sous-phase "development")
                                                                                            $developmentDetails = collect();
                                                                                            if (strtolower($sub->name) === 'development') {
                                                                                                $developmentDetails = $project->developmentDetails
                                                                                                    ->where('subphase_id', $sub->id)
                                                                                                    ->whereIn('status', ['Cancelled', 'Delayed']);
                                                                                            }
                                                                                        @endphp
                                                                                        
                                                                                        {{-- <tr class="{{ $rowClass }}"> --}}
                                                                                            <tr>
                                                                                            <td>
                                                                                                <div class="d-flex align-items-center mb-2">
                                                                                                    <div class="me-2 rounded-circle bg-gold text-white d-flex justify-content-center align-items-center"
                                                                                                        style="width: 18px; height: 18px; font-size: 8px; font-weight: bold;">
                                                                                                        {{ $loop->iteration }}
                                                                                                    </div>
                                                                                                    <div class="pl-2">
                                                                                                        <strong>{{ ucfirst($sub->label) }}</strong>
                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="mt-1 ms-3">
                                                                                                    <small class="text-muted">
                                                                                                        <i class="me-1 fe fe-16 fe-corner-down-right text-secondary"></i>
                                                                                                        @if($isSubphaseCancelledOrDelayed)
                                                                                                            Reason: <em>{{ $sub->pivot->reason ?? 'No reason provided' }}</em>
                                                                                                        @elseif($developmentDetails->isNotEmpty())
                                                                                                            @foreach($developmentDetails as $detail)
                                                                                                                <div>
                                                                                                                    Detail: <strong>{{ $detail->title ?? 'N/A' }}</strong> — 
                                                                                                                    Status: <em>{{ $detail->status }}</em>
                                                                                                                    Status: <em>{{ $detail->reason }}</em>
                                                                                                                </div>
                                                                                                            @endforeach

                                                                                                        @elseif($isAward)
                                                                                                            Awarded to: <strong>{{ $sub->pivot->award_person_name ?? 'N/A' }}</strong>
                                                                                                        @else
                                                                                                            Nothing to report
                                                                                                        @endif
                                                                                                    </small>
                                                                                                </div>
                                                                                            </td>
                                                                                        </tr>

                                                                                    @endforeach
                                                                                </tbody>
                                                                            </table>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>

                                                    <div style="page-break-before: always; padding-top: 50px;""></div>
                                                    {{-- Budget report --}}
                                                    <div class="mb-2">
                                                        <div>
                                                            <strong class="card-title h4 text-black pt-1"><i class="fe fe-dollar-sign fe-24"></i> Budget Report</strong>
                                                        </div>
                                                        <hr style="border: none; height: 3px; background: linear-gradient(to right, #feb47b, #1b1311);">
                                                    </div>
                                                    <div class="card-body p-3 border rounded">

                                                        {{-- Ligne budget + award person --}}
                                                        <div class="row mb-4">
                                                            <div class="col-md-6">
                                                                <h6 class="text-uppercase text-black">Project Budget</h6>
                                                                <p class="fw-bold text-black">{{ number_format($project->budget, 2) }} USD</p>
                                                            </div>

                                                            @php
                                                                $awardSubphase = $project->subphases->firstWhere('name', 'award');
                                                                $awardName = optional($awardSubphase?->pivot)->award_person_name;
                                                            @endphp

                                                            <div class="col-md-6">
                                                                <h6 class="text-uppercase text-black">Awarded to</h6>
                                                                <p class="fw-bold text-success text-black">{{ $awardName ?? '—' }}</p>
                                                            </div>
                                                        </div>

                                                        {{-- Tableau des development details --}}
                                                        @php
                                                            $devDetails = $project->developmentDetails;
                                                        @endphp

                                                        @if($devDetails->isNotEmpty())
                                                            <div class="table-responsive">
                                                                <table class="table table-sm align-middle">
                                                                    <thead class="bg-gold-light text-black">
                                                                        <tr>
                                                                            <th>Title</th>
                                                                            <th>Budget (USD)</th>
                                                                            <th>Status</th>
                                                                            <th>Payment Date</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach($devDetails as $detail)
                                                                            <tr class="text-black table-border-bottom">
                                                                                <td>{{ $detail->title }}</td>
                                                                                <td>{{ number_format($detail->budget_activity, 2) }}</td>
                                                                                <td>
                                                                                    <span class="badge bg-{{ $detail->payment_status === 'Paid' ? 'success' : 'danger' }} p-2 text-white">
                                                                                        {{ ucfirst($detail->payment_status) }}
                                                                                    </span>
                                                                                </td>
                                                                                <td>
                                                                                    @if($detail->payment_status === 'Paid' && $detail->payment_date)
                                                                                        {{ \Carbon\Carbon::parse($detail->payment_date)->format('d M Y') }}
                                                                                    @else
                                                                                        <span class="text-muted">—</span>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        @else
                                                            <p class="text-muted fst-italic">No development activities recorded.</p>
                                                        @endif

                                                    </div>

                                                    <hr style="border: none; height: 3px; background: linear-gradient(to right, #1b1311, #feb47b);">

                                                    {{-- Final comment --}}
                                                    <div class="mb-2">
                                                        <div>
                                                            <strong class="card-title h4 text-black pt-2"><i class="fe fe-file-text fe-24"></i>Conclusion</strong>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="card-body p-1">
                                                            <div class="table-responsive" style="width: 100%">
                                                                <table class="table table-md align-middle" >
                                                                    <thead class="bg-gold-light text-black">
                                                                        <tr>
                                                                            <th>Comment</th>
                                                                            <th>Signature</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="text-black table-border-bottom">
                                                                            <td>{{$project->close_comment}}</td>
                                                                            <td></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                    </div> --}}

                                                    <div class="final-comment-section" style="width: 100%; margin-top: 30px;">
                                <h4 style="color: #000; font-weight: bold; margin-bottom: 15px; border-bottom: 2px solid #C2A756; padding-bottom: 5px;">
                                    Final Comment
                                </h4>

                                <table style="width: 100%; border-collapse: collapse; border: 1px solid #444; font-size: 15px;">
                                    <thead style="background-color: #f7f3e8;">
                                        <tr>
                                            <th style="border: 1px solid #444; padding: 10px; text-align: left;">Comment</th>
                                            <th style="border: 1px solid #444; padding: 10px; text-align: left;">Signature</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="border: 1px solid #444; padding: 12px;">
                                                {{ $project->close_comment ?? '—' }}
                                            </td>
                                            <td style="border: 1px solid #444; padding: 12px; height: 80px;">
                                                {{-- Placeholder for signature --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- /.card-body -->
                        </div> <!-- /.card-body -->
                    </div>
                </div>
            </div> <!-- /.card-body -->
        </div> <!-- /.card -->
    </div> <!-- /.col-12 -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->

       @include('partials.footer')

</main> <!-- main -->
<script>
    function printSection() {
        const printContents = document.getElementById('print-section').innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;

        // Nécessaire pour que les JS re-fonctionnent après le print
        location.reload();
    }
</script>



