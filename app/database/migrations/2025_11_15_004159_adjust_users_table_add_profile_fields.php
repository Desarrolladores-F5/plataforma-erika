<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Si NO existe, la creamos (guard)
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email', 190)->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password', 255);
                $table->rememberToken();
                $table->timestamps();
            });
        }

        // Si ya existe, solo añadimos los campos que falten (cada uno con guard)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name', 80)->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name', 80)->nullable()->after('first_name');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->enum('gender', ['f','m','nb','otro','pref'])->nullable()->after('last_name');
            }
            if (!Schema::hasColumn('users', 'birth_date')) {
                $table->date('birth_date')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address', 180)->nullable()->after('birth_date');
            }
            if (!Schema::hasColumn('users', 'comuna')) {
                $table->string('comuna', 80)->nullable()->after('address');
            }
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone', 40)->nullable()->after('password');
            }
            if (!Schema::hasColumn('users', 'rut')) {
                $table->string('rut', 12)->nullable()->after('phone');
                // índice único protegido por guard
                $table->unique('rut', 'u_rut');
            }
            if (!Schema::hasColumn('users', 'rut_verified')) {
                $table->tinyInteger('rut_verified')->default(0)->after('rut');
            }
            if (!Schema::hasColumn('users', 'role')) {
                $table->enum('role', ['admin','alumno'])->default('alumno')->after('password');
            }
        });
    }

    public function down(): void
    {
        // Revertir SOLO lo que agregamos (sin tirar la tabla entera)
        Schema::table('users', function (Blueprint $table) {
            $drops = [];

            foreach ([
                'first_name','last_name','gender','birth_date','address',
                'comuna','phone','rut_verified','role'
            ] as $col) {
                if (Schema::hasColumn('users', $col)) {
                    $drops[] = $col;
                }
            }

            if (!empty($drops)) {
                $table->dropColumn($drops);
            }

            // índice único del rut
            if (Schema::hasColumn('users', 'rut')) {
                // algunos MySQL requieren dropear el índice por nombre
                try { $table->dropUnique('u_rut'); } catch (\Throwable $e) {}
                $table->dropColumn('rut');
            }
        });
    }
};
