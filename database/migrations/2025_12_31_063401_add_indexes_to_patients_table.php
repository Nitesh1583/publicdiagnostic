<?php
// 2025_12_31_063401_add_indexes_to_patients_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
  public function up()
    {
        // Only add indexes that don't exist
        $indexes = DB::select("SHOW INDEX FROM patients");
        $existing = collect($indexes)->pluck('Key_name')->toArray();

        // Add missing indexes
        if (!in_array('patients_contact_number_index', $existing)) {
            Schema::table('patients', function ($table) {
                $table->index('contact_number');
            });
        }

        if (!in_array('patients_email_index', $existing)) {
            DB::statement('ALTER TABLE patients ADD INDEX patients_email_index (email(191))');
        }
    }
    public function down()
    {
       Schema::table('patients', function ($table) {
            $table->dropIndex(['contact_number']);
        });
        DB::statement('ALTER TABLE patients DROP INDEX IF EXISTS patients_email_index');
    }
};
