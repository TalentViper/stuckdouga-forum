<?php

    namespace App\Http\Controllers\Site;

    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;

    class GoogleController extends Controller
    {
        /**
         * Write code on Method
         *
         * @return response()
         */
        public function index($data)
        {
            return view('admin.googleAutoComplete')->with([
                'data' => $data
            ]);
        }
    }
?>
