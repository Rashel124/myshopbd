<?php

namespace Database\Seeders;

use App\Models\Policy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            [
                'privacy_policy' => 'At E-commerce, we deeply respect your privacy and are committed to protecting the personal information you share with us. This Privacy   Policy explains how we collect, use, and safeguard your data when you use our e-commerce website.',
                'terms_conditions' => 'At E-commerce, we deeply respect your privacy and are committed to protecting the personal information you share with us. This Privacy   Policy explains how we collect, use, and safeguard your data when you use our e-commerce website.',
                'refund_policy' => 'At E-commerce, we deeply respect your privacy and are committed to protecting the personal information you share with us. This Privacy   Policy explains how we collect, use, and safeguard your data when you use our e-commerce website.',
                'payment_policy' => 'At E-commerce, we deeply respect your privacy and are committed to protecting the personal information you share with us. This Privacy   Policy explains how we collect, use, and safeguard your data when you use our e-commerce website.',
                'return_policy' => 'At E-commerce, we deeply respect your privacy and are committed to protecting the personal information you share with us. This Privacy   Policy explains how we collect, use, and safeguard your data when you use our e-commerce website.',
                'about_us' => 'At E-commerce, we deeply respect your privacy and are committed to protecting the personal information you share with us. This Privacy   Policy explains how we collect, use, and safeguard your data when you use our e-commerce website.'
            ]
        ];

        Policy::insert($policies);
    }
}
