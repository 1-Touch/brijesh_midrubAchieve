/*
 * Main javascript file
*/

jQuery(document).ready( function ($) {
    'use strict';

    $('#example').DataTable();

    /*
     * Get the website's url
     */
    var url =  $('meta[name=url]').attr('content');
    
    /*******************************
    METHODS
    ********************************/
       
    /*
     * Load media's employees
     * 
     * @since   0.0.7.6
     */
    Main.loadEmployees = function () {

        var data = {
            action: 'get_employees'
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/achieve', 'GET', data, 'get_employees');
        
    };    
   

    /*******************************
    ACTIONS
    ********************************/

    /*
     * Delete the employee
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.6
     */ 
    $( document ).on( 'click', '.main .delete_employee', function (e) {

        e.preventDefault();

        // Get employee's id
        var employee_id = parseInt($(this).attr('data-id'));

        var data = {
            action: 'delete_employees',
            employee_id: employee_id
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/achieve', 'GET', data, 'delete_employees');
        
    }); 

     /*
     * Delete the employee
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.6
     */ 
    $( document ).on( 'click', '.main .edit_employee', function (e) {

        var employee_id = parseInt($(this).attr('data-id'));

        var data = {
            action: 'get_employee',
            employee_id: employee_id
        };
        
        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/achieve', 'GET', data, 'get_employee');

    }); 

   
    /*******************************
    RESPONSES
    ********************************/
   
     
    /*
     * Display employee's creation response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.6
     */
    Main.methods.achieve_create_new_employee = function ( status, data ) { 
        
        //alert("test");


        if ( status === 'success' ) {

            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Reset the form
            

            //$('#achieve-create-new-employee').display('none');
            if(data.status == 0){
                //$('.achieve-create-new-employee').reset();
                $('#achieve-create-new-employee').modal('toggle');

            } else{
                //$('.achieve-update-new-employee').reset();
                $('#achieve-update-new-employee').modal('toggle');
            }
            // Load all media's categories
            Main.loadEmployees();

        } else {

            Main.popup_fon('sube', data.message, 1500, 2000);

        }
        
    };

    
    /*
     * Display all categories response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.6
     */
    Main.methods.get_employees = function ( status, data ) { 

        // Default categories list var*/
        var employee_list = '<table id="example" class="table table-striped table-bordered" style="width:100%"><thead><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Action</th></tr></thead><tbody>';

        // Verify if categories exists
        if ( status === 'success' ) {
            
            // List all categories
            for ( var i = 0; i < data.employees.length; i++ ) {

                employee_list += '<tr><td>'+data.employees[i].first_name+'</td><td>'+data.employees[i].last_name+'</td><td>'+data.employees[i].email+'</td><td>'+data.employees[i].phone_number+'</td><td><button type="button" data-id = '+data.employees[i].employee_id+ ' class="delete_employee btn btn-default planner-bulk-schedule-history-posts-delete-btn"><i class="icon-trash"></i></button><button data-toggle="modal" data-target="#achieve-update-new-employee" type="button" data-id = '+data.employees[i].employee_id+' class="edit_employee btn btn-default planner-bulk-schedule-history-posts-edit-btn"><i class="icon-pencil"></i></button></td></tr>';
            }

        }
        employee_list +=  '</tbody><tfoot><tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone Number</th><th>Action</th></tr></tfoot></table>';

        // Display the employees in the main list
        $('.main .employees').html(employee_list);  
    };

        
    /*
     * Display delete media employee response
     * 
     * @param string status contains the response status
     * @param object data contains the response content
     * 
     * @since   0.0.7.6
     */
    Main.methods.delete_employees = function ( status, data ) { 
        
        if ( status === 'success' ) {

            Main.popup_fon('subi', data.message, 1500, 2000);
            
            // Reset the form
            //$('.main .achieve-create-new-employee')[0].reset();
            
            // Load all media's categories
            Main.loadEmployees();

        } else {

            Main.popup_fon('sube', data.message, 1500, 2000);

        }
        
    };

    Main.methods.get_employee = function ( status, data ) { 
        
        if ( status === 'success' ) {

            /*console.log(data);
            return false;*/
            var employeeId = data.employee[0].employee_id;
            var firstName = data.employee[0].first_name;
            var lastName = data.employee[0].last_name;
            var email = data.employee[0].email;
            var phoneNumber = data.employee[0].phone_number;

            var formSave = '<button type="submit" class="btn btn-default">Submit</button>';
            
            var updateForm = '<div class="form-group"><label for="first_name">First Name:</label><input required="required" type="text" value='+firstName+' class="form-control first_name" id="first_name" placeholder="First Name" name="first_name"></div><div class="form-group"><label for="last_name">Last Name:</label><input required="required"type="text" value='+lastName+' class="form-control last_name" id="last_name" placeholder="Last Name" name="last_name"></div><div class="form-group"><label for="email">Email:</label><input required="required" type="email" value='+email+' class="form-control email" id="email" placeholder="Email" name="email"></div><div class="form-group"><label for="phone_number">Phone Number:</label><input required="required" type="number" value='+phoneNumber+' class="form-control phone_number" id="phone_number" placeholder="Phone Number" name="phone_number"><input type="hidden" value='+employeeId+' class="form-control employee_id" id="employee_id" placeholder="Employee Id" name="first_name"></div>'+formSave;                

               $('.employeeForm').html(updateForm);

                // Reset the form
                $('.main .achieve-update-new-employee')[0].reset();
                       
        } else {

            Main.popup_fon('sube', data.message, 1500, 2000);

        }
        
    };

       
    /*******************************
    FORMS
    ********************************/
    
    /*
     * Create a new employee
     * 
     * @param object e with global object
     * 
     * @since   0.0.7.6
     */
    $(document).on('submit', '.main .achieve-create-new-employee', function (e) {
        e.preventDefault();
        

        
        var employee_id = $( this ).find( '.employee_id' ).val();
        var first_name = $( this ).find( '.first_name' ).val();
        var last_name = $( this ).find( '.last_name' ).val();
        var email = $( this ).find( '.email' ).val();
        var phone_number = $( this ).find( '.phone_number' ).val();
        
        
        
        // Get employee's name

        // Create an object with form data
        var data = {
            action: 'achieve_create_new_employee',
            employee_id: employee_id,
            first_name: first_name,
            last_name: last_name,
            email: email,
            phone_number: phone_number
        };


        // Set CSRF
        data[$(this).attr('data-csrf')] = $('input[name="' + $(this).attr('data-csrf') + '"]').val();

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/achieve', 'POST', data, 'achieve_create_new_employee');

        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });


    $(document).on('submit', '.main .achieve-update-new-employee', function (e) {
        e.preventDefault();
        
        // Get employee's name
        var first_name = $( this ).find( '.first_name' ).val();
        var last_name = $( this ).find( '.last_name' ).val();
        var email = $( this ).find( '.email' ).val();
        var phone_number = $( this ).find( '.phone_number' ).val();
        
        
        // Create an object with form data
        var data = {
            action: 'achieve_create_new_employee',
            first_name: first_name,
            last_name: last_name,
            email: email,
            phone_number: phone_number
        };

        // Set CSRF
        data[$(this).attr('data-csrf')] = $('input[name="' + $(this).attr('data-csrf') + '"]').val();

        // Make ajax call
        Main.ajax_call(url + 'user/app-ajax/achieve', 'POST', data, 'achieve_create_new_employee');

        // Display loading animation
        $('.page-loading').fadeIn('slow');
        
    });
    
    /*******************************
    DEPENDENCIES
    ********************************/
   
    // Load all employees
    Main.loadEmployees();
    //$('#example').DataTable();
    
});