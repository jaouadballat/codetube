<?php

namespace App\Http\Controllers;

use App\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class ChannelSettingsController extends Controller
{
    public function edit(Channel $channel)
    {
    	$this->authorize('edit', $channel);
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

    	$channel->update([
    		'name' => $request->name,
    		'slug' => $request->slug,
    		'description' => $request->description,
    	]);

        if($request->hasFile('thumbnail')) {

            $path = public_path().'/uploads';

            //check if the path exist 

            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

            $pathname = '/uploads/' .uniqid(true) . '.png';

            Image::make($request->file('thumbnail'))
            ->resize(50, 40)
            ->save(public_path($pathname));

            $channel->update([
                'image' => $pathname 
            ]);
            
        }




    	return redirect()->route('channel.edit', $channel->slug);
    }
}
