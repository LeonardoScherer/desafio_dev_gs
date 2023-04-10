<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use App\Actions\Fortify\CreateNewUser;
use App\Jobs\SendEmailConfirmationForBulkUsers;
use App\Models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\Validator;

class UserService
{
    public function bulkUsersRegistration($file)
    {
        $spreadsheet = IOFactory::load($file);
        $users = $spreadsheet->getActiveSheet()->toArray();
        $line = 0;
        $created = 0;
        $errors = 0;
        $user_already_exists = 0;
        $emails_errors = null;

        foreach ($users as $user) {

            $array = $user;
            if($line == 0) {
                $index_login = array_search('login', $array);
                $index_email = array_search('email', $array);
                $index_password = array_search('password', $array);

            }

            if($index_login === false || $index_email === false || $index_password === false) {
                return [
                    "message" => null,
                    "message_error" => trans('messages.spreadsheet_specifications'),
                    "status" => 422
                ];
            }

            if($line > 1) {
                $exists_user = User::where('email', $user[$index_email])->firstOrNew();
                if (!$exists_user->exists) {


                    $exists_user->email = $user[$index_email];
                    $exists_user->name = $user[$index_login];
                    $exists_user->password = Hash::make($user[$index_password]);
                    $exists_user->is_bulk = 1;

                    $rules = $this->getFieldRules($user,$index_login,$index_email);

                    if($rules['status'] == 'error') {
                        $emails_errors .= PHP_EOL ." <br>" . $user[$index_email];
                        $errors++;
                    } else {
                        $exists_user->save();
                        $created++;
                    }

                } else {
                    $user_already_exists++;
                }
            }

            $line++;
        }
        $message = "<pre>"
                    . trans('messages.Registered users') . ": " . $created . " <br> "
                    . trans('messages.Existing users (not updated)') .": " . $user_already_exists
                . "</pre>";

        return [
            "message" => $message,
            "message_error" => $emails_errors,
            "status" => 200,
        ];

    }

    public function getFieldRules($user, $index_login, $index_email)
    {
        $user = [
            'name' => $user[$index_login],
            'email' => $user[$index_email]
        ];

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ];

        $res = Validator::make($user, $rules);

        if($res->errors()->getMessages())  {
            return [
                "status" => "error",
                "message" => $res->errors()->getMessages()
            ];
        }
        return [
            "status" => "success"
        ];
    }
}
