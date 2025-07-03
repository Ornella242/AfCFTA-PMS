
@include('partials.navbar')
 <div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 5rem; height: 5rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<main role="main" class="main-content fade-in" id="page-transition">
  <div class="container-fluid bg-light p-4">
    <div class="row justify-content-center">
      <div class="col-lg-12">
        <div class="card shadow-lg border-0 rounded-xl">
          <div class="card-body p-5">
            <!-- Header -->
            <div class="d-flex justify-content-between  mb-4">
              <a href="{{ url()->previous() }}" class="btn btn-outline-success shadow-sm">
                <i class="fe fe-arrow-left mr-2"></i> Back
              </a>
              <h2 class="text-maroon text-center font-weight-bold mb-0">New Project Form</h2>
            </div>

            <!-- Alerts -->
            @if(session('success'))
              <div class="alert alert-success shadow-sm">
                {{ session('success') }}
              </div>
            @endif
            @if(session('error'))
              <div class="alert alert-danger shadow-sm">
                {{ session('error') }}
              </div>
            @endif

            <!-- Form Start -->
            <form action="{{ route('projects.store') }}" method="POST">
              @csrf

              <!-- Project Details -->
              <div class="card mb-4 shadow-sm border-0 rounded-xl">
                <div class="card-header bg-gold border-bottom-0">
                  <h5 class="text-white h3 mb-0 font-weight-bold">Project Details</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <label for="title" class="text-black">Project Title</label>
                    <input type="text" id="title" name="title" class="form-control bg-light shadow-sm border-0 rounded-xl" placeholder="Enter project title">
                  </div>
                  <div class="form-group">
                    <label for="description" class="text-black">Description</label>
                    <textarea id="description" name="description" class="form-control bg-light shadow-sm border-0 rounded-xl" rows="3" placeholder="Enter project description"></textarea>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="start_date" class="text-muted">Start Date</label>
                      <input type="text" class="form-control bg-light shadow-sm border-0 rounded-xl drgpicker" id="start_date" name="start_date">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="end_date" class="text-muted">End Date</label>
                      <input type="text" class="form-control bg-light shadow-sm border-0 rounded-xl drgpicker" id="end_date" name="end_date">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="priority" class="text-black">Priority</label>
                      <select name="priority" id="priority" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="status" class="text-black">Status</label>
                      <select name="status" id="status" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        <option value="Not started">Not started</option>
                        <option value="In progress">In progress</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Waiting Approval">Waiting Approval</option>
                        <option value="Delayed">Delayed</option>
                        <option value="Under review">Under review</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="unit" class="text-black">Unit</label>
                      <select name="unit_id" id="unit" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        @foreach($units as $unit)
                          <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="project_manager_id" class="text-black">Project Manager</label>
                      <select name="project_manager_id" id="project_manager_id" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        @foreach($managers as $user)
                          <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="type" class="text-black">Type of Project</label>
                      <select name="type" id="type" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        <option value="HRM">HRM</option>
                        <option value="Admin">Admin</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="partner" class="text-black">Partner(s)</label>
                      <select name="partners[]" id="partner" class="form-control bg-light shadow-sm border-0 rounded-xl select2-multi" multiple>
                        @foreach($partners as $partner)
                          <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="budget" class="text-black">Budget (USD)</label>
                      <input type="number" step="0.01" name="budget" id="budget" class="form-control bg-light shadow-sm border-0 rounded-xl" placeholder="Enter budget amount">
                    </div>
                  </div>
                </div>
              </div>

              <!-- Phases -->
              <hr style="border: none; height: 6px; background: linear-gradient(to right, #feb47b, #1b1311);">

              <h5 class="mb-3 text-dark h4 font-weight-bold">Phases</h5>
              <div class="d-flex flex-wrap">
               @foreach($phases as $phase)
                  <div class="{{ $phase->name === 'implementation' ? 'col-md-12' : '' }} mr-4 mb-4 p-3 border rounded  shadow-sm bg-white" style="{{ $phase->name !== 'implementation' ? 'min-width: 260px;' : '' }}">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="{{ $phase->id }}" id="phase_{{ $phase->id }}" name="phases[]">
                      <label class="form-check-label font-weight-bold text-dark" for="phase_{{ $phase->id }}">
                        {{ $phase->label ?? $phase->name }}
                      </label>
                    </div>

                    @if($phase->name === 'procurement')
                      <div id="procurementTypeContainer" class="ml-3 mt-2 d-none">
                        <label class="font-weight-bold">Type of Procurement:</label>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="procurement_type" id="afcfta" value="afcfta">
                          <label class="form-check-label" for="afcfta">AfCFTA Procurement</label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="procurement_type" id="procurement_type_partner" value="partner">
                          <label class="form-check-label" for="procurement_type_partner">Partner Procurement</label>
                        </div>
                        <div id="partnerSubphases" class="d-none">
                          @php $partnerSub = $phases->pluck('subphases')->flatten()->where('name', 'partner_procurement')->first(); @endphp
                          @if($partnerSub)
                            <input type="checkbox" class="partner-checkbox" name="subphases[procurement_partner][]" value="{{ $partnerSub->id }}">
                          @endif
                        </div>
                        <div id="afcftaSubphases" class="ml-4 d-none">
                          <label class="font-weight-bold">AfCFTA Procurement Sub-phases:</label>
                          @foreach($phase->subphases->where('type', 'afcfta') as $sub)
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="{{ $sub->id }}" id="afcfta_{{ $sub->id }}">
                              <label class="form-check-label" for="afcfta_{{ $sub->id }}">{{ $sub->label ?? $sub->name }}</label>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    @endif

                    @php $filteredSubphases = $phase->subphases->filter(fn($sub) => is_null($sub->type)); @endphp
                    @if($filteredSubphases->count())
                      <div class="ml-3 border-left pl-3">
                        @foreach($filteredSubphases as $sub)
                          <div class="form-check">
                            <input class="form-check-input {{ $sub->name === 'development' ? 'dynamic-trigger' : '' }}" type="checkbox" name="subphases[{{ $phase->id }}][]" value="{{ $sub->id }}" id="sub_{{ $sub->id }}">
                            <label class="form-check-label" for="sub_{{ $sub->id }}">{{ $sub->label ?? $sub->name }}</label>
                          </div>
                          @if($sub->name === 'development')
                            <div id="dynamicActivities" class="ml-3 mt-2 d-none">
                              <label>Development phases:</label>
                              <div id="activityInputs">
                                <div class="form-row align-items-center mb-2">
                                  <div class="col">
                                    <input type="text" name="development_activities[]" class="form-control" placeholder="Enter activity title">
                                  </div>
                                  <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        @endforeach
                      </div>
                    @endif
                  </div>
                @endforeach

              </div>

              <!-- Submit Button -->
              <div class="text-right mt-4">
                <button type="submit" class="btn bg-maroon shadow-sm rounded-pill text-white px-4 py-2">
                  <i class="fe fe-save mr-2 text-white"></i> Save Project
                </button>
              </div>

            </form>
            <!-- End Form -->
          </div>
        </div>
      </div>
    </div>
  </div>

</main>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const procurementCheckbox = document.getElementById("phase_{{ $phases->firstWhere('name', 'procurement')?->id }}");
    const procurementTypeContainer = document.getElementById("procurementTypeContainer");
    const afcftaRadio = document.getElementById("afcfta");
    const partnerRadio = document.getElementById("procurement_type_partner");
    const afcftaSubphases = document.getElementById("afcftaSubphases");
    const partnerSubphases = document.getElementById("partnerSubphases");
    const partnerInputs = document.querySelectorAll(".partner-checkbox");

    // Afficher ou masquer le type de procurement
    if (procurementCheckbox) {
      procurementCheckbox.addEventListener("change", function () {
        if (this.checked) {
          procurementTypeContainer.classList.remove("d-none");
        } else {
          procurementTypeContainer.classList.add("d-none");
          afcftaSubphases.classList.add("d-none");
          partnerSubphases.classList.add("d-none");
          afcftaRadio.checked = false;
          partnerRadio.checked = false;
          partnerInputs.forEach(input => {
            input.checked = false;
          });
        }
      });
    }

    // Quand AfCFTA est sélectionné
    if (afcftaRadio) {
      afcftaRadio.addEventListener("change", function () {
        afcftaSubphases.classList.remove("d-none");
        partnerSubphases.classList.add("d-none");
        partnerInputs.forEach(input => {
          input.checked = false;
        });
      });
    }

    // Quand Partner est sélectionné
    if (partnerRadio) {
      partnerRadio.addEventListener("change", function () {
        afcftaSubphases.classList.add("d-none");
        partnerSubphases.classList.remove("d-none");
        partnerInputs.forEach(input => {
          input.checked = true;
        });
      });
    }
  });
</script>






{{-- <script>
  document.addEventListener("DOMContentLoaded", function () {
    const procurementCheckbox = document.getElementById("phase_{{ $phases->firstWhere('name', 'procurement')?->id }}");
    const procurementTypeContainer = document.getElementById("procurementTypeContainer");
    const afcftaRadio = document.getElementById("afcfta");
    const partnerRadio = document.getElementById("procurement_type_partner");
    const afcftaSubphases = document.getElementById("afcftaSubphases");

    if (procurementCheckbox) {
      procurementCheckbox.addEventListener("change", function () {
        if (this.checked) {
          procurementTypeContainer.classList.remove("d-none");
        } else {
          procurementTypeContainer.classList.add("d-none");
          afcftaSubphases.classList.add("d-none");
          afcftaRadio.checked = false;
          partnerRadio.checked = false;
        }
      });
    }

    if (afcftaRadio) {
      afcftaRadio.addEventListener("change", function () {
        afcftaSubphases.classList.remove("d-none");
      });
    }

    if (partnerRadio) {
      partnerRadio.addEventListener("change", function () {
        afcftaSubphases.classList.add("d-none");
      });
    }
  });
</script> --}}

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const triggerCheckbox = document.querySelector(".dynamic-trigger");
    const dynamicSection = document.getElementById("dynamicActivities");
    const addButtonClass = "add-activity";

    if (triggerCheckbox && dynamicSection) {
      triggerCheckbox.addEventListener("change", function () {
        if (this.checked) {
          dynamicSection.classList.remove("d-none");
        } else {
          dynamicSection.classList.add("d-none");
          // Reset
          document.getElementById("activityInputs").innerHTML = `
            <div class="form-row align-items-center mb-2">
              <div class="col">
                <input type="text" name="development_activities[]" class="form-control" placeholder="Enter activity title">
              </div>
              <div class="col-auto">
                <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
              </div>
            </div>`;
        }
      });

      // Handle Add button
      document.getElementById("activityInputs").addEventListener("click", function (e) {
        if (e.target.classList.contains(addButtonClass)) {
          const newInput = document.createElement("div");
          newInput.className = "form-row align-items-center mb-2";
          newInput.innerHTML = `
            <div class="col">
              <input type="text" name="development_activities[]" class="form-control" placeholder="Enter activity title">
            </div>
            <div class="col-auto">
              <button type="button" class="btn btn-sm btn-outline-danger remove-activity">Remove</button>
            </div>`;
          this.appendChild(newInput);
        }
      });

      // Handle Remove button
      document.getElementById("activityInputs").addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-activity")) {
          e.target.closest(".form-row").remove();
        }
      });
    }
  });
</script>

<script>
  // Affiche le spinner quand on clique sur "Retour arrière" ou on recharge
  window.addEventListener("pageshow", function (event) {
    const spinner = document.getElementById("loading-spinner");

    if (event.persisted || performance.getEntriesByType("navigation")[0].type === "back_forward") {
      spinner.style.display = "flex";
    }
  });

  // Affiche le spinner manuellement quand on clique sur les liens de retour
  document.querySelectorAll('.btn-back, .btn-refresh').forEach(btn => {
    btn.addEventListener('click', function () {
      document.getElementById("loading-spinner").style.display = "flex";
    });
  });
</script>
 <script>
      $('.select2').select2(
      {
        theme: 'bootstrap4',
      });
      $('.select2-multi').select2(
      {
        multiple: true,
        theme: 'bootstrap4',
      });
    </script>

 <script src='{{ asset('js/select2.min.js') }}'></script>
@include('partials.footer')