<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
    <title>Perform Inspection | MonSiKon</title>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<section class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">MonSiKon</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('surveyor/dashboard') ?>">Surveyor Dashboard</a></li>
                            <li class="breadcrumb-item active">Perform Inspection</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Inspection for Container <?= $container->container_number ?></h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                    <form action="<?= site_url('surveyor/submit/'.$inspection->id_inspection) ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>

                            <div class="row">
                                <!-- Container Details Section -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Container Details</label>
                                        <div class="border p-3 rounded">
                                            <p><strong>Container Number:</strong> <?= $container->container_number ?></p>
                                            <p><strong>Container Type:</strong> <?= $container->type ?></p>
                                            <p><strong>Capacity:</strong> <?= $container->capacity ?></p>
                                            <p><strong>Current Status:</strong> 
                                                <span class="badge bg-<?= $container->status == 'available' ? 'success' : 'warning' ?>">
                                                    <?= ucfirst($container->status) ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="inspection_photo" class="form-label">Inspection Photo</label>
                                        <div class="card border-dashed border-2 text-center p-4">
                                            <input type="file" name="inspection_photo" id="inspection_photo" class="form-control" accept="image/*">
                                            <small class="text-muted">Upload container inspection photo</small>
                                        </div>
                                    </div>
                                
                                </div>

                                <!-- Inspection Photo Section -->
                                <div class="col-lg-6">
                                    
                                    <!-- Container Code Input Section -->
                                    <div class="mb-3">
                                        <label for="container_code_image" class="form-label">Upload Container Code</label>
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="container_code_image" name="container_code_image" accept="image/*">
                                            <button type="button" class="btn btn-primary" id="scan_button">Scan</button>
                                        </div>
                                        <small class="text-muted">Upload an image and click Scan to extract the container code using OCR.</small>
                                    </div>
                                    <!-- Ganti input text menjadi textarea -->
                                    <div class="mb-3 card border-dashed border-2 text-center p-4">
                                        <label for="container_code" class="form-label">Container Code (Verify and Edit if Necessary)</label>
                                        <textarea class="form-control" id="container_code" name="container_code" rows="10" placeholder="Container code will appear here after scanning"></textarea>
                                    </div>
                                </div>
                                
                            </div>

                            <!-- New Fields Section (Inspection Details) -->
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="inspection_date" class="form-label">Inspection Date</label>
                                        <input type="date" class="form-control" id="inspection_date" name="inspection_date" value="<?= old('inspection_date', $inspection->inspection_date ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="arrival_time" class="form-label">Arrival Time</label>
                                        <input type="time" class="form-control" id="arrival_time" name="arrival_time" value="<?= old('arrival_time', $inspection->arrival_time ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="departure_time" class="form-label">Departure Time</label>
                                        <input type="time" class="form-control" id="departure_time" name="departure_time" value="<?= old('departure_time', $inspection->departure_time ?? '') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="inspection_time" class="form-label">Inspection Time</label>
                                        <input type="time" class="form-control" id="inspection_time" name="inspection_time" value="<?= old('inspection_time', $inspection->inspection_time ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="seal_no" class="form-label">Seal Number</label>
                                        <input type="text" class="form-control" id="seal_no" name="seal_no" value="<?= old('seal_no', $inspection->seal_no ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="buyer" class="form-label">Buyer</label>
                                        <input type="text" class="form-control" id="buyer" name="buyer" value="<?= old('buyer', $inspection->buyer ?? '') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="po_number" class="form-label">PO Number</label>
                                        <input type="text" class="form-control" id="po_number" name="po_number" value="<?= old('po_number', $inspection->po_number ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="inspector_name" class="form-label">Inspector Name</label>
                                        <input type="text" class="form-control" id="inspector_name" name="inspector_name" value="<?= old('inspector_name', $inspection->inspector_name ?? '') ?>">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label for="witness_name" class="form-label">Witness Name</label>
                                        <input type="text" class="form-control" id="witness_name" name="witness_name" value="<?= old('witness_name', $inspection->witness_name ?? '') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="inner_cleaned" class="form-label">Inner Cleaned</label>
                                        <select class="form-control" id="inner_cleaned" name="inner_cleaned">
                                            <option value="1" <?= old('inner_cleaned', $inspection->inner_cleaned ?? '') == '1' ? 'selected' : '' ?>>Yes</option>
                                            <option value="0" <?= old('inner_cleaned', $inspection->inner_cleaned ?? '') == '0' ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="outer_cleaned" class="form-label">Outer Cleaned</label>
                                        <select class="form-control" id="outer_cleaned" name="outer_cleaned">
                                            <option value="1" <?= old('outer_cleaned', $inspection->outer_cleaned ?? '') == '1' ? 'selected' : '' ?>>Yes</option>
                                            <option value="0" <?= old('outer_cleaned', $inspection->outer_cleaned ?? '') == '0' ? 'selected' : '' ?>>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Inspection Criteria Section -->
<div class="row mt-4">
    <div class="col-12">
        <h4>Inspection Criteria</h4>
        
        <?php 
        $criteria = [
            'undercarriage' => 'Outside Undercarriage',
            'inside_wall' => 'Inside Wall',
            'right_door' => 'Right Side Door',
            'left_door' => 'Left Side Door',
            'front_wall' => 'Front Wall',
            'ceiling' => 'Ceiling',
            'roof' => 'Roof',
            'floor_inside' => 'Floor Inside',
            'fifth_wheel' => 'Fifth Wheel Area',
            'exterior_front' => 'Exterior Front',
            'rear_bumper' => 'Rear Bumper/Door'
        ];
        ?>

<?php foreach ($criteria as $field => $label): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title"><?= $label ?></h5>
                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label">Condition</label>
                            <div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Good" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Good' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Good</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Rust" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Rust' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Rust</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Bruise" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Bruise' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Bruise</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Hole" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Hole' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Hole</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Dent" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Dent' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Dent</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Broken" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Broken' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Broken</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Scratch" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Scratch' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Scratch</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="<?= $field ?>_result" value="Patched" 
                                    <?= old($field.'_result', $inspection->{$field.'_result'} ?? '') == 'Patched' ? 'checked' : '' ?>>
                                    <label class="form-check-label">Patched</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label class="form-label">Upload Photo</label>
                            <input type="file" class="form-control" name="<?= $field ?>_image" accept="image/*">
                        </div>
                        <?php if (!empty($inspection->{$field.'_image'})): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('upload_criteria/'.$inspection->{$field.'_image'}) ?>" 
                                 alt="<?= $label ?> Photo" 
                                 class="img-thumbnail" 
                                 style="max-height: 150px">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

                            <!-- Inspection Result Section -->
                            <div class="row">
                                <div class="col-12">
                                    
                                    <div class="mb-3">
                                        <h4 class="card-title" for="result" class="form-label">Inspection Final Result</h4>
                                        <textarea class="form-control" id="result" name="result" rows="5" placeholder="Describe the condition of the container, any damages, or issues found"><?= old('result', $inspection->result ?? '') ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- Add before the submit buttons section -->
<div class="row mb-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Inspector Signature</h5>
                <div class="mb-3">
                    <canvas id="inspectorSignature" class="border" width="400" height="200"></canvas>
                    <input type="hidden" name="inspector_signature_data" id="inspector_signature_data">
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearSignature('inspectorSignature')">Clear</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Witness Signature</h5>
                <div class="mb-3">
                    <canvas id="witnessSignature" class="border" width="400" height="200"></canvas>
                    <input type="hidden" name="witness_signature_data" id="witness_signature_data">
                </div>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary btn-sm" onclick="clearSignature('witnessSignature')">Clear</button>
                </div>
            </div>
        </div>
    </div>
</div>
                            <!-- Submit and Cancel Buttons -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-success">
                                            <i class="mdi mdi-check"></i> Complete Inspection
                                        </button>
                                        <a href="<?= site_url('surveyor/dashboard') ?>" class="btn btn-light">Cancel</a>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.getElementById('scan_button').addEventListener('click', function () {
        const fileInput = document.getElementById('container_code_image');
        if (fileInput.files.length === 0) {
            alert('Please upload an image first.');
            return;
        }

        const formData = new FormData();
        formData.append('image', fileInput.files[0]);

        fetch('<?= site_url('inspection/scan') ?>', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('container_code').value = data.code;
            } else {
                alert('OCR failed: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error during OCR:', error);
            alert('An error occurred while performing OCR.');
        });
    });
</script>
<!-- Add this script section after the existing script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/4.1.5/signature_pad.umd.min.js"></script>
<script>
    let inspectorPad, witnessPad;
    
    document.addEventListener('DOMContentLoaded', function() {
    // Initialize Inspector's signature pad
    const inspectorCanvas = document.getElementById('inspectorSignature');
    inspectorPad = new SignaturePad(inspectorCanvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
    
    // Initialize Witness's signature pad
    const witnessCanvas = document.getElementById('witnessSignature');
    witnessPad = new SignaturePad(witnessCanvas, {
        backgroundColor: 'rgb(255, 255, 255)'
    });
    
    // Handle form submission
    document.querySelector('form').addEventListener('submit', function(e) {
        if (!inspectorPad.isEmpty()) {
            // Get signature data without the data URL prefix
            const inspectorData = inspectorPad.toDataURL('image/png')
                .replace('data:image/png;base64,', '');
            document.getElementById('inspector_signature_data').value = inspectorData;
        }
        
        if (!witnessPad.isEmpty()) {
            // Get signature data without the data URL prefix
            const witnessData = witnessPad.toDataURL('image/png')
                .replace('data:image/png;base64,', '');
            document.getElementById('witness_signature_data').value = witnessData;
        }
    });
});

function clearSignature(canvasId) {
    if (canvasId === 'inspectorSignature') {
        inspectorPad.clear();
        document.getElementById('inspector_signature_data').value = '';
    } else if (canvasId === 'witnessSignature') {
        witnessPad.clear();
        document.getElementById('witness_signature_data').value = '';
    }
}
</script>
<?= $this->endSection() ?>
