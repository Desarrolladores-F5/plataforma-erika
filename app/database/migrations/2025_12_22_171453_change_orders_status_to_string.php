<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status VARCHAR(20) NOT NULL DEFAULT 'pendiente'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE orders
            MODIFY status ENUM('pendiente','pagado','rechazado') NOT NULL DEFAULT 'pendiente'
        ");
    }
};
