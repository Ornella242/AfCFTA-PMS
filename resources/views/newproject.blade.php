
@include('partials.navbar')
 <div id="loading-spinner" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(255,255,255,0.7); z-index: 9999; justify-content: center; align-items: center;">
  <div class="spinner-grow mr-3 text-success" role="status" style="width: 5rem; height: 5rem;">
    <span class="sr-only">Loading...</span>
  </div>
</div>
<main role="main" class="main-content fade-in" id="page-transition">
  <div class="container-fluid bg-grey p-4">
    <div class="row justify-content-center">
      <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                  <!-- Back Button -->
                  <div>
                      <a href="{{ url()->previous() }}" class="btn btn-outline-success btn-back shadow-sm transition-all">
                          <i class="fe fe-arrow-left mr-2"></i> Back
                      </a>
                  </div>

                  <!-- Page Title -->
                  <div>
                      <h2 class="mb-0 page-title text-center text-black">New Project Form</h2>
                  </div>
              <div class="row align-items-center mb-4">
                        <div class="col-12">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        </div>
                </div>

                </div>
              </div> <!-- .row -->
              <div class="pl-2">
                <form action="{{ route('projects.store') }}" method="POST">
                  @csrf
                  <h5 class="mb-2 mt-4 text-maroon">Project details</h5>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="title">Project title</label>
                      <input type="text" id="title" name="title" class="form-control">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter project description"></textarea>
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <label for="date-input1">Start Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control drgpicker" id="date-input1" name="start_date" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16 mx-2"></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="date-input1">End Date</label>
                        <div class="input-group">
                            <input type="text" class="form-control drgpicker" id="date-input1" name="end_date" aria-describedby="button-addon2">
                            <div class="input-group-append">
                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16 mx-2"></span></div>
                            </div>
                        </div>
                    </div>
                  
                    <div class="form-group col-md-4">
                      <label for="priority">Priority</label>
                      <select id="priority" name="priority" class="form-control">
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                      </select>
                    </div>
    
                    <div class="form-group col-md-4">
                      <label for="status">Status</label>
                      <select id="status" name="status" class="form-control">
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
                      <label for="unit">Unit</label>
                      <select class="form-control" id="unit" name="unit_id">
                        @foreach($units as $unit)
                          <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                      </select>
                    </div>
    
                    <div class="form-group col-md-4">
                      <label for="manager">Project Manager</label>
                      <select class="form-control" id="manager" name="project_manager_id">
                        @foreach($managers as $user)
                          <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                        @endforeach
                      </select>
                    </div>
    
                    <div class="form-group col-md-4">
                      <label for="type">Type of project</label>
                      <select class="form-control" id="type" name="type">
                        <option value="HRM">HRM</option>
                        <option value="Admin">Admin</option>
                      </select>
                    </div>
    
                    <div class="form-group col-md-4">
                      <label for="partner">Partner(s)</label>
                          <select class="form-control select2-multi" id="partner" name="partners[]" multiple>           
                                         @foreach($partners as $partner)
                          <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                      </select>
                    </div>
    
                    
                    <div class="form-group col-md-4">
                        <label for="budget">Budget (USD)</label>
                        <input type="number" step="0.01" class="form-control" id="budget" name="budget" placeholder="Enter budget amount">
                    </div>
                  </div>
    
                  <hr class="my-4">
                  <h5 class="mb-2 mt-4 text-maroon">Phases</h5>
                  <div class="d-flex flex-wrap">
                      @foreach($phases as $phase)
                          <div class="mr-4 mb-3" style="min-width: 250px;">
                              <!-- Checkbox de la phase -->
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="{{ $phase->id }}" id="phase_{{ $phase->id }}" name="phases[]">
                                  <label class="form-check-label font-weight-bold text-maroon" for="phase_{{ $phase->id }}">
                                      {{ $phase->label ?? $phase->name }}
                                  </label>
                              </div>

                              {{-- Cas particulier pour Procurement --}}
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

                                      {{-- Sous-phases partner (invisibles mais soumises) --}}
                                      <div id="partnerSubphases" class="d-none">
                                          @php
                                              $partnerSub = $phases->pluck('subphases')->flatten()->where('name', 'partner_procurement')->first();
                                          @endphp
                                          @if($partnerSub)
                                              <input type="checkbox" 
                                                    class="partner-checkbox"
                                                    name="subphases[procurement_partner][]" 
                                                    value="{{ $partnerSub->id }}">
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

                              {{-- Sous-phases générales --}}
                              @php
                                  $filteredSubphases = $phase->subphases->filter(fn($sub) => is_null($sub->type));
                              @endphp

                              @if($filteredSubphases->count())
                                  <div class="ml-3 border-left pl-2">
                                      @foreach($filteredSubphases as $sub)
                                          <div class="form-check">
                                              <input
                                                  class="form-check-input {{ $sub->name === 'development' ? 'dynamic-trigger' : '' }}"
                                                  type="checkbox"
                                                  name="subphases[{{ $phase->id }}][]"
                                                  value="{{ $sub->id }}"
                                                  id="sub_{{ $sub->id }}">
                                              <label class="form-check-label" for="sub_{{ $sub->id }}">
                                                  {{ $sub->label ?? $sub->name }}
                                              </label>
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

                  <hr class="my-4">
                  <div class="form-row">
                    <div class="col-md-12 d-flex justify-content-end">
                      <button type="submit" class="btn bg-maroon text-white">Save Project</button>
                    </div>
                  </div>
    
                </form>
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