<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\GradeSeeder;
use Database\Seeders\MailSetting;
use Database\Seeders\FLPFileSeeder;
use Database\Seeders\LUPFileSeeder;
use Database\Seeders\LUPTypeSeeder;
use Database\Seeders\LUPSubTypeSeeder;
use Database\Seeders\RDMSUomSeeder;
use Database\Seeders\AuditLUPSeeder;
use Database\Seeders\ICCSPathSeeder;
use Database\Seeders\PasswordSeeder;
use Database\Seeders\FLPActionSeeder;
use Database\Seeders\FLPParentSeeder;
use Database\Seeders\LUPActionSeeder;
use Database\Seeders\LUPParentSeeder;
use Database\Seeders\RDMSBatchSeeder;
use Database\Seeders\SAPPrefixSeeder;
use Database\Seeders\DepartmentSeeder;
use Database\Seeders\MasterPartSeeder;
use Database\Seeders\MailSettingSeeder;
use Database\Seeders\ICCSApprovalSeeder;
use Database\Seeders\RDMSKonversiSeeder;
use Database\Seeders\ClearAuditLoginSeeder;
use Database\Seeders\FLPActionStatusSeeder;
use Database\Seeders\LUPActionStatusSeeder;
use Database\Seeders\RDMSStockInDataSeeder;
use Database\Seeders\RelatedMaterialSeeder;
use Database\Seeders\RDMSStockOutDataSeeder;
use Database\Seeders\RelatedDepartmentSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GradeSeeder::class,
            UserSeeder::class,
            MailSettingSeeder::class,
            AuditLUPSeeder::class,
            DepartmentSeeder::class,            
            ICCSPathSeeder::class,
            FLPParentSeeder::class,
            FLPActionSeeder::class,
            FLPActionStatusSeeder::class,
            PasswordSeeder::class,
            FLPFileSeeder::class,
            MasterPartSeeder::class,
            ClearAuditLoginSeeder::class,
            SAPPrefixSeeder::class,
            RDMSUomSeeder::class,
            RDMSBatchSeeder::class,
            RDMSKonversiSeeder::class,
            RDMSStockInDataSeeder::class,
            RDMSStockOutDataSeeder::class,
            ICCSApprovalSeeder::class,
            LUPParentSeeder::class,
            LUPActionSeeder::class,
            LUPActionStatusSeeder::class,
            LUPFileSeeder::class,
            LUPTypeSeeder::class,
            RelatedDepartmentSeeder::class,
            RelatedMaterialSeeder::class,

        ]);
    }
}
