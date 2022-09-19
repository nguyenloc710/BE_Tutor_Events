<?php

namespace App\Services;

use App\Models\Subject;

class SubjectServices
{
    public function getAll()
    {
        return Subject::paginate(DEFAULT_PAGINATE);
    }

    public function create($data)
    {
        return Subject::create($data);
    }

    public function update($data,$subject)
    {
        return $subject->update($data);
    }

    public function destroy($id)
    {
        $subject = Subject::find($id);
        $subject->delete();
        return $subject->trashed();
    }
}