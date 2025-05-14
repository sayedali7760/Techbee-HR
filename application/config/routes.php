<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */

$route['settings'] = 'Dashboard_controller/settings';
$route['logout'] = 'Login/logout';
$route['home'] = 'dashboard_controller';
$route['error'] = 'Login/error';
$route['login/login'] = 'Login/loginaction';
$route['admin'] = 'Login/admin_login';
$route['home/dashboard'] = 'dashboard_controller';
$route['login/forgot-password'] = 'Login/forgot_password_check';
$route['update-forgot-password?(:any)'] = 'Login/change_password_user';
$route['forgot-password/update-password'] = 'Login/update_password';
$route['signup'] = 'Login/signup';
$route['register'] = 'Login/register';

// user management
$route['user-management/user-add'] = 'settings/User_management/user_add';
$route['user-management/save-user'] = 'settings/User_management/save_user';
$route['user-management/user-show'] = 'settings/User_management/user_list';
$route['user-management/edit-user'] = 'settings/User_management/edit_user';
$route['user-management/update-user'] = 'settings/User_management/update_user';
$route['user-management/change_status'] = 'settings/User_management/change_status';
$route['user-management/edit-profile'] = 'settings/User_management/edit_profile_self';
$route['user-management/client-add'] = 'settings/User_management/client_add';
$route['user-management/save-client'] = 'settings/User_management/save_client';
$route['user-management/client-show'] = 'settings/User_management/client_list';
$route['user-management/edit-client'] = 'settings/User_management/edit_client';
$route['user-management/update-client'] = 'settings/User_management/update_client';
$route['user-management/change-password'] = 'settings/User_management/change_user_password';
$route['user-management/update-logo'] = 'settings/User_management/update_logo';
$route['admin-crm/update-thumbnail'] = 'settings/User_management/update_thumbnail';



$route['client/client-show'] = 'settings/Client_crm/show_client';
$route['client/change_status'] = 'settings/Client_crm/change_status';
$route['client/my-profile'] = 'settings/Client_crm/my_profile';
$route['client-crm/update-password'] = 'settings/Client_crm/update_password';
$route['admin-crm/update-password'] = 'settings/User_management/update_password_admin';
$route['client-crm/upload-doc'] = 'settings/Client_crm/upload_doc';
$route['client-crm/update-thumbnail'] = 'settings/Client_crm/update_thumbnail';

$route['client-crm/show-product'] = 'settings/Client_crm/show_product';
$route['client-crm/view-product'] = 'settings/Client_crm/view_product';
$route['client-crm/client-verify'] = 'settings/Client_crm/client_verification';
$route['client-crm/update-doc-status'] = 'settings/Client_crm/update_doc_status';
$route['client-crm/activate-client'] = 'settings/Client_crm/activate_client';


$route['client/refund'] = 'settings/Payment/refund';
$route['admin/refund'] = 'settings/Payment/admin_refund';
$route['client/refund-save'] = 'settings/Payment/refund_save';
$route['client/applied-refund'] = 'settings/Payment/applied_refund';
$route['client/approve-refund'] = 'settings/Payment/approve_refund';
$route['client/reject-refund'] = 'settings/Payment/reject_refund';
$route['client/view-refund'] = 'settings/Payment/view_refund';
$route['client/get-staff-refund-details'] = 'settings/Payment/get_staff_refund_details';

$route['client/payroll'] = 'settings/Payment/payroll';
$route['client/payroll-payment-save'] = 'settings/Payment/payroll_payment_save';
$route['client/payroll-added'] = 'settings/Payment/payroll_added';
$route['client/client-salary-history'] = 'settings/Payment/client_salary_history';
$route['client/show-bank-details-client'] = 'settings/Client_crm/show_bank_details_client';

$route['task/scheule-task'] = 'settings/Task/schedule_task';
$route['task/scheule-task-save'] = 'settings/Task/schedule_task_save';
$route['task/scheuled-tasks'] = 'settings/Task/scheduled_tasks';
$route['task/assigned-tasks'] = 'settings/Task/assigned_tasks';
$route['task/change_status'] = 'settings/Task/change_status';
$route['task/view-task'] = 'settings/Task/view_task';

$route['leave/apply-leave'] = 'settings/Leave/apply_leave';
$route['leave/leave-save'] = 'settings/Leave/apply_leave_save';
$route['leave/applied-leave'] = 'settings/Leave/applied_leave';
$route['leave/applied-leave-admin'] = 'settings/Leave/applied_leave_admin';
$route['leave/approve-leave'] = 'settings/Leave/approve_leave';
$route['leave/reject-leave'] = 'settings/Leave/reject_leave';


$route['client/my-data'] = 'settings/Client_crm/my_data';
$route['client/bdata-save'] = 'settings/Client_crm/bank_data';
$route['client/wallet-save'] = 'settings/Client_crm/wallet_id';
$route['client/show-bank-details'] = 'settings/Client_crm/show_bank_details';
$route['client/reject-bank-data'] = 'settings/Client_crm/reject_bank_data';
$route['client/approve-bank-data'] = 'settings/Client_crm/approve_bank_data';
$route['mt/group_update'] = 'settings/Mt_Accounts/group_update';
$route['mt/group_change'] = 'settings/Mt_Accounts/group_change';
$route['login/forgot-password'] = 'Login/forgot_pwd';
$route['login/reset-password'] = 'Login/reset_pwd';





$route['default_controller'] = 'Login';
$route['404_override'] = 'Login/error';
$route['translate_uri_dashes'] = false;
