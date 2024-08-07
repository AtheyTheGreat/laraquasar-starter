<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;

class AttachmentController extends BaseController
{
    public function __construct()
    {
        $this->model = Status::class;
        $this->relation = [];
        $this->allowedFilters = [];
        $this->allowedIncludes = [];
        $this->allowedSorts = ['id'];
    }

    public function upload(Request $request)
    {
        // return 'sdsdd';
        $attachmentIds = [];


        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $file_name = str_replace(' ', '_', $file->getClientOriginalName());
                $file->storeAs('public/uploads', $file_name);
                $filePath = $file_name;

                $newAttachment = Attachment::create([
                    'file' => $filePath,
                ]);

                $attachmentIds[] = $newAttachment->id;
            }
        }

        // dd($attachmentIds);
        return $attachmentIds;
    }
}
