
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
            <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data">
              @csrf

              <!-- Project Details -->
              <div class="card mb-4 shadow-sm border-0 rounded-xl">
                <div class="card-header bg-gold border-bottom-0">
                  <h5 class="text-white h3 mb-0 font-weight-bold">Project Details</h5>
                </div>
                <div class="card-body">
                  <div class="form-group">
                    <img src="{{ asset('images/icons/title.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <label for="title" class="text-black">Project Title</label>
                    <input type="text" id="title" name="title" class="form-control bg-light shadow-sm border-0 rounded-xl" placeholder="Enter project title">
                    @error('title')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-group">
                    <img src="{{ asset('images/icons/description.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                    <label for="description" class="text-black">Description</label>
                    <textarea id="description" name="description" class="form-control bg-light shadow-sm border-0 rounded-xl" rows="3" placeholder="Enter project description"></textarea>
                    @error('description')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/date.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="start_date" class="text-muted">Start Date</label>
                      <input type="text" class="form-control bg-light shadow-sm border-0 rounded-xl drgpicker" id="start_date" name="start_date">
                    @error('start_date')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/date.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="end_date" class="text-muted">End Date</label>
                      <input type="text" class="form-control bg-light shadow-sm border-0 rounded-xl drgpicker" id="end_date" name="end_date">
                      @error('end_date')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/priority.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="priority" class="text-black">Priority</label>
                      <select name="priority" id="priority" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        <option value="" disabled selected>Select priority</option>
                        <option value="High">High</option>
                        <option value="Medium">Medium</option>
                        <option value="Low">Low</option>
                      </select>
                      @error('priority')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/status.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="status" class="text-black">Status</label>
                      <select name="status" id="status" class="form-control bg-light shadow-sm border-0 rounded-xl">
                       <option value="" disabled selected>Select status</option>
                        <option value="Not started">Not started</option>
                        <option value="In progress">In progress</option>
                        <option value="Completed">Completed</option>
                        <option value="Cancelled">Cancelled</option>
                        <option value="Waiting Approval">Waiting Approval</option>
                        <option value="Delayed">Delayed</option>
                        <option value="Under review">Under review</option>
                      </select>
                      @error('status')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group col-md-4">
                        <img src="{{ asset('images/icons/unit.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="unit" class="text-black">Unit</label>
                      <select name="unit_id" id="unit" class="form-control bg-light shadow-sm border-0 rounded-xl">
                       <option value="" disabled selected>Select unit</option>
                        @foreach($units as $unit)
                          <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                        @endforeach
                      </select>
                      @error('unit_id')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/user.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="project_manager_id" class="text-black">Project Manager</label>
                      <select name="project_manager_id" id="project_manager_id" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        @foreach($managers as $user)
                          <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                        @endforeach
                      </select>
                      @error('project_manager_id')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/projecttype.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="type" class="text-black">Type of Project</label>
                      <select name="type" id="type" class="form-control bg-light shadow-sm border-0 rounded-xl">
                        <option value="" disabled selected>Select type of project</option>
                        <option value="HRM">HRM</option>
                        <option value="Admin">Admin</option>
                      </select>
                      @error('type')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/partners.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="partner" class="text-black">Partner(s)</label>
                      <select name="partners[]" id="partner" class="form-control bg-light shadow-sm border-0 rounded-xl select2-multi" multiple>
                       <option value="" disabled selected>Select partner</option>
                        @foreach($partners as $partner)
                          <option value="{{ $partner->id }}">{{ $partner->name }}</option>
                        @endforeach
                      </select>
                        @error('partners')
                          <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group col-md-4">
                      <img src="{{ asset('images/icons/budget.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="budget" class="text-black">Budget (USD)</label>
                      <input type="number" step="0.01" name="budget" id="budget" class="form-control bg-light shadow-sm border-0 rounded-xl" placeholder="Enter budget amount">
                      @error('budget')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                    <div class="form-group col-md-6">
                      <img src="{{ asset('images/icons/budget.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                      <label for="budget_code" class="text-black">Budget Code</label>
                      <input type="text" name="budget_code" id="budget_code" class="form-control bg-light shadow-sm border-0 rounded-xl" placeholder="Enter budget code">
                      @error('budget_code')
                        <small class="text-danger">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>

              <!-- Phases -->
              <hr style="border: none; height: 6px; background: linear-gradient(to right, #feb47b, #1b1311);">
              <h4 class="mb-3 text-dark h4 font-weight-bold">
                <img src="{{ asset('images/icons/pmphases.png') }}" alt="Dashboard" class="icon-img" style="width:20px; height:20px;">
                Phases
              </h4>
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
                            <input
                              class="form-check-input"
                              type="checkbox"
                              name="subphases[procurement_afcfta][]"
                              value="{{ $sub->id }}"
                              id="afcfta_{{ $sub->id }}">
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
                              {{-- <div id="activityInputs">
                                <div class="form-row align-items-center mb-2">
                                  <div class="col">
                                    <input type="text" name="development_activities[]" class="form-control" placeholder="Enter activity title">
                                  </div>
                                  <div class="col">
                                    <input type="number" step="0.01" name="budget_activities[]" class="form-control" placeholder="Activity Budget (optional)">
                                  </div>
                                  <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
                                  </div>
                                </div>
                              </div> --}}
                              <div id="activityInputs">
                                <div class="form-row align-items-center mb-2" data-index="0">
                                  <div class="col">
                                    <input type="text" name="development_activities[0][title]" class="form-control" placeholder="Enter activity title">
                                  </div>
                                  <div class="col">
                                    <input type="number" step="0.01" name="development_activities[0][budget]" class="form-control" placeholder="Activity Budget (optional)">
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

              <!-- Supporting Documents -->
              <hr style="border: none; height: 6px; background: linear-gradient(to right, #1b1311, #feb47b);">
              <h4 class="mb-3 text-dark h4 font-weight-bold">
                <i class="fe fe-paperclip text-maroon mr-2"></i>
                Supporting Documents
              </h4>

              <div class="card mb-4 shadow-sm border-0 rounded-xl">
                <div class="card-body">
                  <div class="form-group">
                    <label for="supporting_documents" class="text-black font-weight-bold">
                      Attach files (optional)
                    </label>
                    <input 
                      type="file" 
                      name="supporting_documents[]" 
                      id="supporting_documents" 
                      class="form-control bg-light shadow-sm border-0 rounded-xl" 
                      multiple
                    >

                    <small class="form-text text-muted">
                      You can attach multiple files (PDF, Word, Excel, Images, etc.)
                    </small>

                    @error('supporting_documents.*')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror

                        <!-- Preview zone -->
                      <div id="file-preview" class="mt-3"></div>
                  </div>
                </div>
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
  document.getElementById('supporting_documents').addEventListener('change', function (e) {
    const preview = document.getElementById('file-preview');
    preview.innerHTML = ''; // reset preview

    Array.from(e.target.files).forEach(file => {
      let icon = 'file'; // default
      if (file.type.includes('pdf')) icon = 'file-text';
      else if (file.type.includes('image')) icon = 'image';
      else if (file.type.includes('word') || file.name.endsWith('.doc') || file.name.endsWith('.docx')) icon = 'file';
      else if (file.type.includes('excel') || file.name.endsWith('.xls') || file.name.endsWith('.xlsx')) icon = 'file';

      const fileItem = document.createElement('div');
      fileItem.classList.add('d-flex', 'align-items-center', 'mb-2');

      fileItem.innerHTML = `
        <i data-feather="${icon}" class="me-2"></i>
        <span class="text-truncate">${file.name}</span>
      `;
      preview.appendChild(fileItem);
    });

    feather.replace(); // refresh icons
  });
</script>
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



<script>
document.addEventListener("DOMContentLoaded", function () {
    const triggerCheckbox = document.querySelector(".dynamic-trigger");
    const dynamicSection = document.getElementById("dynamicActivities");
    const activityInputs = document.getElementById("activityInputs");
    const addButtonClass = "add-activity";
    let index = 1; // L'index commence à 1 car l'input initial est à 0

    // ✅ Réaction au clic sur la checkbox
    if (triggerCheckbox && dynamicSection) {
        triggerCheckbox.addEventListener("change", function () {
            if (this.checked) {
                dynamicSection.classList.remove("d-none");
            } else {
                dynamicSection.classList.add("d-none");
                // Réinitialiser les inputs
                activityInputs.innerHTML = `
                    <div class="form-row align-items-center mb-2" data-index="0">
                        <div class="col">
                            <input type="text" name="development_activities[0][title]" class="form-control" placeholder="Enter activity title">
                        </div>
                        <div class="col">
                            <input type="number" step="0.01" name="development_activities[0][budget]" class="form-control" placeholder="Activity Budget (optional)">
                        </div>
                        <div class="col-auto">
                            <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
                        </div>
                    </div>`;
                index = 1;
            }
        });
    }

    // ✅ Ajouter une nouvelle ligne
    activityInputs.addEventListener("click", function (e) {
        if (e.target.classList.contains(addButtonClass)) {
            const newInput = document.createElement("div");
            newInput.className = "form-row align-items-center mb-2";
            newInput.setAttribute("data-index", index);

            newInput.innerHTML = `
                <div class="col">
                    <input type="text" name="development_activities[${index}][title]" class="form-control" placeholder="Enter activity title">
                </div>
                <div class="col">
                    <input type="number" step="0.01" name="development_activities[${index}][budget]" class="form-control" placeholder="Activity Budget (optional)">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-outline-danger remove-activity">Remove</button>
                </div>`;

            activityInputs.appendChild(newInput);
            index++;
        }
    });

    // ✅ Supprimer une ligne
    activityInputs.addEventListener("click", function (e) {
        if (e.target.classList.contains("remove-activity")) {
            e.target.closest(".form-row").remove();
        }
    });
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
