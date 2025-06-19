@include('partials.navbar')
<main role="main" class="main-content">
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-12 col-xl-10">
        <div class="row align-items-center my-4">
          <div class="col">
            <h2 class="h3 mb-0 page-title">New project</h2>
          </div>
          <div class="col-auto">
            <button type="button" class="btn bg-maroon text-white">Add project</button>
          </div>
        </div>
        <form action="{{ route('projects.store') }}" method="POST">
          @csrf
          <hr class="my-4">
          <h5 class="mb-2 mt-4 text-maroon">Project details</h5>
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="title">Project title</label>
              <input type="text" id="personalFirstname" class="form-control">
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
                    <input type="text" class="form-control drgpicker" id="date-input1" value="04/24/2020" aria-describedby="button-addon2">
                    <div class="input-group-append">
                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16 mx-2"></span></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
               <label for="date-input1">End Date</label>
                <div class="input-group">
                    <input type="text" class="form-control drgpicker" id="date-input1" value="04/24/2020" aria-describedby="button-addon2">
                    <div class="input-group-append">
                    <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16 mx-2"></span></div>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-4">
              <label for="language">Priority</label>
              <select id="language" class="form-control">
                <option value="high">High</option>
                <option value="medium">Medium</option>
                <option value="medium">Low</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="language">Status</label>
              <select id="language" class="form-control">
                <option value="pending">Pending</option>
                <option value="processing">Processing</option>
                <option value="completed">Completed</option>
              </select>
            </div>
            <div class="form-group col-md-4">
              <label for="unit">Unit</label>
                <select class="form-control" id="unit" name="unit">
                    <option value="HR">HR</option>
                    <option value="Facilities">Facilities</option>
                    <option value="IT">IT</option>
                    <option value="Procurement">Procurement</option>
                    <option value="Travel">Travel</option>
                    <option value="Transport">Transport</option>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="PM">Project Manager</label>
                <select class="form-control" id="manager" name="manager">
                    <option value="Director">Director</option>
                    <option value="Head">Head of Division</option>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="TP">Type of project</label>
                <select class="form-control" id="manager" name="manager">
                    <option value="hrm">HRM</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="form-group col-md-4">
              <label for="Partner">Partner</label>
                <select class="form-control" id="partner" name="partner">
                    <option value="AfDB">AfDB</option>
                    <option value="AUC">AUC</option>
                    <option value="MS-1">MS-1</option>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="budget">Budget (USD)</label>
                <input type="number" step="0.01" class="form-control" id="budget" name="budget" placeholder="Enter budget amount">
            </div>
          </div>

          <hr class="my-4">

          <h5 class="mb-2 mt-4 text-maroon">Phases</h5>
         <!-- Phases -->
        <div class="form-group mt-4">
        <div class="form-row">
            <!-- Phase: TOR -->
            <div class="col-md-6">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="tor" id="phaseTor" name="phases[]">
                <label class="form-check-label font-weight-bold text-maroon" for="phaseTor">Terms of Reference</label>
            </div>

            <!-- Sous-phases TOR -->
            <div class="ml-4 pl-3 border-left">
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="needs_analysis" id="tor1">
                <label class="form-check-label" for="tor1">Preparation</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="objectives_definition" id="tor2">
                <label class="form-check-label" for="tor2">Availability of funds</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="stakeholder_consultation" id="tor3">
                <label class="form-check-label" for="tor3">Validation</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="drafting_tor" id="tor4">
                <label class="form-check-label" for="tor4">SG Approval</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[tor][]" value="approval" id="tor5">
                <label class="form-check-label" for="tor5">Procurement Request</label>
                </div>
            </div>
            </div>

            <!-- Phase: Procurement -->
            <div class="col-md-6">
            <div class="form-check mb-2">
                <input class="form-check-input" type="checkbox" value="procurement" id="phaseProcurement" name="phases[]">
                <label class="form-check-label text-maroon font-weight-bold" for="phaseProcurement">Procurement</label>
            </div>

            <!-- Type de Procurement -->
            <div id="procurementTypeContainer" class="ml-4 mb-2 d-none">
                <label class="font-weight-bold">Type of Procurement:</label>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="procurement_type" id="afcfta" value="afcfta">
                <label class="form-check-label" for="afcfta">AfCFTA Procurement</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="procurement_type" id="partner" value="partner">
                <label class="form-check-label" for="partner">Partner Procurement</label>
                </div>
            </div>

            <!-- Sous-phases AfCFTA -->
            <div id="afcftaSubphases" class="ml-5 d-none">
                <label class="font-weight-bold">AfCFTA Procurement Sub-phases:</label>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="needs_assessment" id="afcfta1">
                <label class="form-check-label" for="afcfta1">Tender document</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="rfp_preparation" id="afcfta2">
                <label class="form-check-label" for="afcfta2">Advertisement</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="advertising" id="afcfta3">
                <label class="form-check-label" for="afcfta3">Evaluation & Negociation</label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="checkbox" name="subphases[procurement_afcfta][]" value="evaluation" id="afcfta4">
                <label class="form-check-label" for="afcfta4">Award</label>
                </div>
            </div>
            </div>
        </div>

        <!-- Phase: Implementation -->
        <div class="form-check mb-2 mt-3">
            <input class="form-check-input" type="checkbox" value="implementation" id="phaseImplementation" name="phases[]">
            <label class="form-check-label text-maroon font-weight-bold" for="phaseImplementation">Implementation</label>
        </div>

        <!-- Sous-phases Implementation -->
        <div id="implementationSubphases" class="ml-4">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="launch_meeting" id="imp1">
            <label class="form-check-label" for="imp1">Team Set</label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="work_plan" id="imp2">
            <label class="form-check-label" for="imp2">Work Plan</label>
            </div>
            <div class="form-check">
            <input class="form-check-input dynamic-trigger" type="checkbox" name="subphases[implementation][]" value="activities" id="imp3">
            <label class="form-check-label" for="imp3">Development</label>
            </div>

            <!-- Zone dynamique : Development phases -->
            <div id="dynamicActivities" class="ml-4 mt-2 d-none">
            <label>Development phases:</label>
            <div id="activityInputs">
                <div class="form-row align-items-center mb-2">
                <div class="col">
                    <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
                </div>
                <div class="col-auto">
                    <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
                </div>
                </div>
            </div>
            </div>

            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="monitoring" id="imp4">
            <label class="form-check-label" for="imp4">Control & Validation</label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="reporting" id="imp5">
            <label class="form-check-label" for="imp5">Training</label>
            </div>
            <div class="form-check">
            <input class="form-check-input" type="checkbox" name="subphases[implementation][]" value="closing" id="imp6">
            <label class="form-check-label" for="imp6">Service</label>
            </div>
        </div>
        </div>

          <hr class="my-4">
          <div class="form-row">
            <div class="col-md-6 text-right">
              <button type="submit" class="btn bg-maroon text-white">Save Change</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const procurementCheckbox = document.getElementById("phaseProcurement");
    const procurementTypeContainer = document.getElementById("procurementTypeContainer");
    const afcftaRadio = document.getElementById("afcfta");
    const partnerRadio = document.getElementById("partner");
    const afcftaSubphases = document.getElementById("afcftaSubphases");

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

    afcftaRadio.addEventListener("change", function () {
      afcftaSubphases.classList.remove("d-none");
    });

    partnerRadio.addEventListener("change", function () {
      afcftaSubphases.classList.add("d-none");
    });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const triggerCheckbox = document.getElementById("imp3");
    const dynamicSection = document.getElementById("dynamicActivities");
    const addButtonClass = "add-activity";

    // Show/hide dynamic input area
    triggerCheckbox.addEventListener("change", function () {
      if (this.checked) {
        dynamicSection.classList.remove("d-none");
      } else {
        dynamicSection.classList.add("d-none");
        // Optionally clear inputs
        document.getElementById("activityInputs").innerHTML = `
          <div class="form-row align-items-center mb-2">
            <div class="col">
              <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
            </div>
            <div class="col-auto">
              <button type="button" class="btn btn-sm btn-outline-primary add-activity">Add</button>
            </div>
          </div>`;
      }
    });

    // Delegate "Add" button clicks to append new input lines
    document.getElementById("activityInputs").addEventListener("click", function (e) {
      if (e.target.classList.contains(addButtonClass)) {
        const newInput = document.createElement("div");
        newInput.className = "form-row align-items-center mb-2";
        newInput.innerHTML = `
          <div class="col">
            <input type="text" name="implementation_activities[]" class="form-control" placeholder="Enter activity title">
          </div>
          <div class="col-auto">
            <button type="button" class="btn btn-sm btn-outline-danger remove-activity">Remove</button>
          </div>`;
        this.appendChild(newInput);
      }
    });

    // Handle "Remove" button
    document.getElementById("activityInputs").addEventListener("click", function (e) {
      if (e.target.classList.contains("remove-activity")) {
        e.target.closest(".form-row").remove();
      }
    });
  });
</script>
@include('partials.footer')