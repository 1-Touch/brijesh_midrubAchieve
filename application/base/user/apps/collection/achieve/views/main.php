    <section class="section storage-page">
        <div class="col-xl-12">
            <div style="padding:10px;">
                <button data-toggle="modal" data-target="#achieve-create-new-employee" type="button" class="btn btn-default planner-bulk-schedule-history-posts-edit-btn">Add Employee</i></button><br>
            </div>

            <div class="employees">
                
            </div>
        </div>
    </section>

    <div class="modal fade" id="achieve-update-new-employee" tabindex="-1" role="dialog" aria-labelledby="storage-create-new-category" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <?php echo form_open('user/app/achieve', ['class' => 'achieve-create-new-employee ', 'data-csrf' => $this->security->get_csrf_token_name()]) ?>
                <div class="modal-header">
                    <h5 class="modal-title">
                        Employee Updation
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body employeeForm">
                </div>
                <div class="modal-footer">
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="achieve-create-new-employee" tabindex="-1" role="dialog" aria-labelledby="storage-create-new-category" aria-hidden="true">
    <div class="modal-dialog file-upload-box modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <?php echo form_open('user/app/achieve', ['class' => 'achieve-create-new-employee ', 'data-csrf' => $this->security->get_csrf_token_name()]) ?>
                <div class="modal-header">
                    <h5 class="modal-title">
                        Employee Information
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="first_name">First Name:</label>
                      <input required="required" type="text" class="form-control first_name" id="first_name" placeholder="First Name" name="first_name">
                    </div>
                    <div class="form-group">
                      <label for="last_name">Last Name:</label>
                      <input required="required" type="text" class="form-control last_name" id="last_name" placeholder="Last Name" name="last_name">
                    </div>
                    <div class="form-group">
                      <label for="email">Email:</label>
                      <input required="required" type="email" class="form-control email" id="email" placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                      <label for="phone_number">Phone Number:</label>
                      <input required="required" type="number" class="form-control phone_number" id="phone_number" placeholder="Phone Number" name="phone_number">
                    </div>
                    <button type="submit" class="btn btn-default">Submit</button>
                </div>
                <div class="modal-footer">
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>



