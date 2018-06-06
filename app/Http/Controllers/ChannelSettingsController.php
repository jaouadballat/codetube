<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ChannelSettingsController extends Controller
{
    public function edit(Channel $channel)
    {
    	return view('channel.settings.index', ['channel' => $channel]);
    }

    public function update(Request $request, Channel $channel)
    {

    	
    	$validator = Validator::make($request->all(), [

    		'name' => ['required', 
			    		Rule::unique('channels')->ignore($channel->id),
			    		'max:250'
			    ],
			'slug'   =>	['required',
						Rule::unique('channels')->ignore($channel->id),
						'max:250'
				],
			'description' => 'required|max:1000'
    	]);

    	if($validator->fails()) {
    		return redirect()->back()->withErrors($validator);
    	}

    	$this->authorize('update', $channel);

    	dd($request->all());
    }
}
