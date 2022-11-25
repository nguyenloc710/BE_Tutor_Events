<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassStudent\ClassStudentRequest;
use App\Http\Requests\ClassStudent\UpdateClassStudentRequest;
use App\Services\BreadcrumbServices;
use App\Services\ClassroomServices;
use App\Services\ClassStudentServices;
use Illuminate\Http\Request;

class ClassStudentController extends Controller
{
    private $classStudentServices;
    private $classroomServices;
    private $breadcrumbServices;

    public function __construct(
        ClassStudentServices $classStudentServices,
        ClassroomServices $classroomServices,
        BreadcrumbServices $breadcrumbServices
    ) {
        $this->classStudentServices = $classStudentServices;
        $this->classroomServices = $classroomServices;
        $this->breadcrumbServices = $breadcrumbServices;
    }

    public function studentsInClassroom(Request $request)
    {
        $classroomId = $request->classroom_id;

        $students = $this->classStudentServices->classStudentsInClassroom($classroomId);
        $tree = $this->breadcrumbServices->getByClassroom($classroomId);

        return response([
            'data' => $students,
            'tree' => $tree
        ], 200);
    }

    public function update(UpdateClassStudentRequest $request)
    {
        $data = $request->input();
        $data->classroom_id = $request->classroom_id;

        $this->classStudentServices->update($data);

        return response([
            'message' => 'Cập nhật sinh viên thành công',
        ], 201);
    }
}
