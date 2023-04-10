<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRegistrationSpreadsheet;
use App\Services\UserService;


class AdminController extends Controller
{
    public function showSpreadsheetUploadToRegisterUsers()
    {
        return view('admin\show-spreadsheet-upload');
    }

    public function storeSpreadsheetUploadToRegisterUsers(StoreUserRegistrationSpreadsheet $request)
    {
        $file = $request->file;

        $res = (new UserService())->bulkUsersRegistration($file);

        $message = $res['message'];
        if($res["message_error"]) {
            $message_error = trans("messages.emails_error") . $res["message_error"];
        } else {
            $message_error = null;
        }

        return view('admin\show-spreadsheet-upload', compact('message', 'message_error'));
    }
}
