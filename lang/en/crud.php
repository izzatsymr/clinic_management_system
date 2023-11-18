<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'appointments' => [
        'name' => 'Appointments',
        'index_title' => 'Appointments List',
        'new_title' => 'New Appointment',
        'create_title' => 'Create Appointment',
        'edit_title' => 'Edit Appointment',
        'show_title' => 'Show Appointment',
        'inputs' => [
            'date_time' => 'Date Time',
            'status' => 'Status',
            'note' => 'Note',
            'patient_id' => 'Patient',
            'user_id' => 'User',
        ],
    ],

    'assessments' => [
        'name' => 'Assessments',
        'index_title' => 'Assessments List',
        'new_title' => 'New Assessment',
        'create_title' => 'Create Assessment',
        'edit_title' => 'Edit Assessment',
        'show_title' => 'Show Assessment',
        'inputs' => [
            'patient_id' => 'Patient',
        ],
    ],

    'patients' => [
        'name' => 'Patients',
        'index_title' => 'Patients List',
        'new_title' => 'New Patient',
        'create_title' => 'Create Patient',
        'edit_title' => 'Edit Patient',
        'show_title' => 'Show Patient',
        'inputs' => [
            'name' => 'Name',
            'contact_no' => 'Contact No',
            'address' => 'Address',
            'email' => 'Email',
            'emergency_contact' => 'Emergency Contact',
            'date_of_birth' => 'Date Of Birth',
            'gender' => 'Gender',
            'medical_history' => 'Medical History',
        ],
    ],

    'questions' => [
        'name' => 'Questions',
        'index_title' => 'Questions List',
        'new_title' => 'New Question',
        'create_title' => 'Create Question',
        'edit_title' => 'Edit Question',
        'show_title' => 'Show Question',
        'inputs' => [
            'question_text' => 'Question Text',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'contact_no' => 'Contact No',
            'address' => 'Address',
            'date_of_birth' => 'Date Of Birth',
            'gender' => 'Gender',
            'email' => 'Email',
            'password' => 'Password',
            'specialization' => 'Specialization',
            'schedule' => 'Schedule',
        ],
    ],

    'roles' => [
        'name' => 'Roles',
        'index_title' => 'Roles List',
        'create_title' => 'Create Role',
        'edit_title' => 'Edit Role',
        'show_title' => 'Show Role',
        'inputs' => [
            'name' => 'Name',
        ],
    ],

    'permissions' => [
        'name' => 'Permissions',
        'index_title' => 'Permissions List',
        'create_title' => 'Create Permission',
        'edit_title' => 'Edit Permission',
        'show_title' => 'Show Permission',
        'inputs' => [
            'name' => 'Name',
        ],
    ],
];
