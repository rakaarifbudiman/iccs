<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RDMSBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sqlquery = "INSERT INTO rdms_be.rdms_batches (partbatch,
            part,
            batch,
            expired,
            deleted,   
            created_by,
            notes,
            storage,
            stock_in,
            stock_out,
            stock,
            created_at)
        SELECT PartBatch,PartNo,NoBatch,Expired,CeklistPemusnahan,CreatedBy,AddNote,Storage,Masuk,Keluar,Stock,DateInput
        FROM old_iccs.old_rdms_batch";
        $result = DB::select(DB::raw($sqlquery));
    }
}
