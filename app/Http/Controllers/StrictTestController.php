<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StrictTestController extends Controller
{
    public function __invoke(Request $request)
    {
        $value = $request->value;

        $default = [
            'integer' => 25,
            'boolean' => false,
            'float' => 100.0,
            'string' => 'Test string'
        ];

        $types = array_keys($default);

        $normal = [];
        $strict = [];

        $hasValue = $request->has('value');

        if ($hasValue) {
            foreach ($types as $type) {
                $normal[$type] = $request->$type('value', $default[$type]);
                $strict[$type] = $request->$type('value', $default[$type], true);
            }
        }

        return view('strict-test', compact('value', 'default', 'types', 'normal', 'strict', 'hasValue'));
    }
}
