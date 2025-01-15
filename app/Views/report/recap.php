<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Survey Schedule | MonSiKon</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">MonSiKon</a></li>
                            <li class="breadcrumb-item"><a href="#">Navigation</a></li>
                            <li class="breadcrumb-item active">Survey Schedule</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Survey Schedule</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="javascript:void(0);" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addScheduleModal"><i class="mdi mdi-plus-circle me-2"></i> Add Schedule</a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button>
                                </div>
                            </div>
                        </div>
                
                        <div class="table-responsive">
                            <table class="table table-centered w-100 dt-responsive nowrap" id="products-datatable">
                                <thead class="table-light">
                                    <tr>
                                        <th class="all" style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1">&nbsp;</label>
                                            </div>
                                        </th>
                                        <th class="all">Name Container</th>
                                        <th>Destination</th>
                                        <th>Inspection Schedule</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Status</th>
                                        <th style="width: 85px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Evergreen</td>
                                        <td>Saudi Arabia</td>
                                        <td>nando@gmail.com</td>
                                        <td>09/12/2018</td>
                                        <td><span class="badge bg-success">Inspected</span></td>
                                        <td class="table-action">
                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#inspectionModal"> 
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="action-icon"> 
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck3">
                                                <label class="form-check-label" for="customCheck3">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>Maersk</td>
                                        <td>America</td>
                                        <td>budi@gmail.com</td>
                                        <td>09/12/2018</td>
                                        <td><span class="badge bg-danger">Uninspected</span></td>
                                        <td class="table-action">
                                            <a href="javascript:void(0);" class="action-icon" data-bs-toggle="modal" data-bs-target="#inspectionModal"> 
                                                <i class="mdi mdi-square-edit-outline"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="action-icon"> 
                                                <i class="mdi mdi-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> <!-- end card-body-->
                </div> <!-- end card-->
            </div> <!-- end col -->
        </div>
        <!-- end row -->   

    </div> <!-- container -->

    <!-- Add Schedule Modal -->
    <div class="modal fade" id="addScheduleModal" tabindex="-1" aria-labelledby="addScheduleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addScheduleModalLabel">Add Schedule</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="addScheduleForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="destination" class="form-label">Destination</label>
                            <input type="text" class="form-control" id="destination" required>
                        </div>
                        <div class="mb-3">
                            <label for="inspectionSchedule" class="form-label">Inspection Schedule</label>
                            <input type="text" class="form-control" id="inspectionSchedule" required>
                        </div>
                        <div class="mb-3">
                            <label for="contactPerson" class="form-label">Contact Person</label>
                            <input type="email" class="form-control" id="contactPerson" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" required>
                                <option value="Inspected">Inspected</option>
                                <option value="Uninspected">Uninspected</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitSchedule">Save Schedule</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inspection Modal -->
    <div class="modal fade" id="inspectionModal" tabindex="-1" aria-labelledby="inspectionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inspectionModalLabel">Container Inspection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="inspectionForm">
                        <div class="mb-3">
                            <label for="suitability" class="form-label">Suitability</label>
                            <input type="text" class="form-control" id="suitability" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Upload Photos</label>
                            <div class="mb-2">
                                <label for="frontPhoto" class="form-label">Front Photo</label>
                                <input type="file" class="form-control" id="frontPhoto" accept="image/*" required>
                            </div>
                            <div class="mb-2">
                                <label for="backPhoto" class="form-label">Back Photo</label>
                                <input type="file" class="form-control" id="backPhoto" accept="image/*" required>
                            </div>
                            <div class="mb-2">
                                <label for="topPhoto" class="form-label">Top Photo</label>
                                <input type="file" class="form-control" id="topPhoto" accept="image/*" required>
                            </div>
                            <div class="mb-2">
                                <label for="insidePhoto" class="form-label">Inside Photo</label>
                                <input type="file" class="form-control" id="insidePhoto" accept="image/*" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="finalReview" class="form-label">Final Review</label>
                            <textarea class="form-control" id="finalReview" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submitInspection">Save Inspection</button>
                </div>
            </div>
        </div>
    </div>

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>
    <script>
        document.getElementById('submitInspection').addEventListener('click', function() {
            const inspectionForm = document.getElementById('inspectionForm');
            
            if (inspectionForm.checkValidity()) {
                // Handle the form submission logic here (e.g., AJAX call)
                alert('Inspection data saved successfully!'); // Replace with your logic
                
                // Close the modal
                var modal = bootstrap.Modal.getInstance(document.getElementById('inspectionModal'));
                modal.hide();
                
                // Optionally reset the form
                inspectionForm.reset();
            } else {
                inspectionForm.reportValidity();
            }
        });
    </script>

</section>
<?= $this->endSection(); ?>
