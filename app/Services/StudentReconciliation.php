<?php
namespace App\Services;

use App\Models\Reconcile;
use App\Models\Student;
use League\Csv\Reader;

class StudentReconciliation {
    /**
     * Takes in a Reconcile object with a link to a csv file
     * Creates or updates each student in the file and returns the stats of the run
     *
     * @param Reconcile $reconcile
     * @return Reconcile
     */
    public static function reconcile (Reconcile $reconcile) : Reconcile {
        $csv = Reader::createFromPath($reconcile->file_path);
        // skip header
        $csv->setOffset(1);
        $created = 0;
        $updated = 0;

        $csv->each(function ($row) use (&$created, &$updated, $reconcile) {
            if (Student::withTrashed()->find($row[0])) {
                $updated++;
            } else {
                $created++;
            }

            $student = Student::withTrashed()->firstOrCreate([ 'id' => $row[0] ]);
            $student->update([
                'last_name'     => $row[1],
                'first_name'    => $row[2],
                'reconcile_id'  => $reconcile->id
            ]);
            $student->restore();

            return true;
        });

        // delete any students no longer in the system
        // take a count of them first so we can update the reconcile record
        $toDelete = Student::where('reconcile_id', '<>', $reconcile->id);
        $toDeleteCount = $toDelete->count();
        $toDelete->delete();

        $reconcile->update([
            'created' => $created,
            'updated' => $updated,
            'deleted' => $toDeleteCount,
            'was_success' => true,
        ]);

        return $reconcile;
    }
}