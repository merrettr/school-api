<?php
namespace App\Services;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ReportService {
    public function getStudentReport() : Collection {
        return DB::table('student')
            ->select('observation.id', 'student.id as student_id', 'student.first_name', 'student.last_name', 'behaviour.description', 'observation.created_at as latest', DB::raw('count(*) as count'))
            ->join('observation', 'observation.student_id', '=', 'student.id')
            ->join('behaviour', 'behaviour.id', '=', 'observation.behaviour_id')
            ->groupBy('student.id', 'behaviour.id')
            ->orderBy('student.last_name')
            ->orderBy('student.first_name')
            ->orderBy('behaviour.description')
            ->get();
    }

    public function getBehaviourReport() : Collection {
        return DB::table('behaviour')
            ->select('behaviour.description', DB::raw('MAX(observation.created_at) as latest'), DB::raw('COUNT(*) as count'))
            ->join('observation', 'observation.behaviour_id', '=', 'behaviour.id')
            ->groupBy('observation.behaviour_id')
            ->orderBy('behaviour.description')
            ->get();
    }

    public function getTeacherReport() : Collection {
        return DB::table('users')
            ->select('users.first_name', 'users.last_name', 'behaviour.description', DB::raw('MAX(observation.created_at) as latest'), DB::raw('COUNT(*) as count'))
            ->join('observation', 'observation.user_id', '=', 'users.id')
            ->join('behaviour', 'behaviour.id', '=', 'observation.behaviour_id')
            ->groupBy('users.id', 'behaviour.id')
            ->orderBy('users.last_name')
            ->orderBy('users.first_name')
            ->get();
    }
}