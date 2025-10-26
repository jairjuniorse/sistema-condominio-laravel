<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $blocks = ['A', 'B', 'C', 'D', 'E'];
        $floors = [0, 1, 2, 3]; // Terreo, 1º, 2º, 3º andar
        $apartmentsPerFloor = 6;
        
        $units = [];

        foreach ($blocks as $block) {
            foreach ($floors as $floor) {
                for ($apt = 1; $apt <= $apartmentsPerFloor; $apt++) {
                    $floorCode = $floor === 0 ? '00' : $floor . '0';
                    $aptCode = str_pad($apt, 2, '0', STR_PAD_LEFT);
                    
                    $units[] = [
                        'code' => $block . $floorCode . $aptCode,
                        'block' => $block,
                        'number' => $floorCode . $aptCode,
                        'type' => 'Apartamento',
                        'rooms' => $apt <= 3 ? 2 : 3, // Apt 1-3: 2 quartos, 4-6: 3 quartos
                        'area' => $apt <= 3 ? 65.00 : 85.00,
                        'status' => 'vago',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
            }
        }

        Unit::insert($units);
        
        echo "✅ " . count($units) . " unidades criadas com sucesso!\n";
        echo "📋 Padrão: A001-A006, A101-A106, A201-A206, A301-A306 (repetindo para blocos B, C, D, E)\n";
    }
}