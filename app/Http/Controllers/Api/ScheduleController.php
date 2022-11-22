<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\ScheduleServices;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    private $scheduleServices;

    public function __construct(
        ScheduleServices $scheduleServices
    ) {
        $this->scheduleServices = $scheduleServices;
    }

    public function studentSchedule()
    {
        $lesson = $this->scheduleServices->studentSchedule();
        return response([
            'data' => $lesson,
        ], 200);
    }

    public function studentScheduleHistory(Request $request)
    {
        $response = $this->scheduleServices->getStudentScheduleBySemesterId($request->semester_id);
        
        return $response;
    }

    public function teacherTutorSchedule()
    {
        $lesson = $this->scheduleServices->teacherTutorSchedule();
        return response([
            'data' => $lesson,
        ], 200);
    }

    public function missingClasses()
    {
        $classrooms = $this->scheduleServices->studentMissingClasses();

        return response([
            'data' => $classrooms,
        ], 200);
    }

    public function joinClass(Request $request)
    {
        $joined = $this->scheduleServices->joinClass($request->classroom_id);

        return response([
            'message' => $joined ? 'Tham gia lớp học thành công' : 'Bạn không có trong danh sách lớp này',
        ], 200);
    }
}
