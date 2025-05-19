<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organization;

class OrganizationDescriptionsSeeder extends Seeder
{
    public function run()
    {
        $descriptions = [
            1 => [
                'short' => 'A trusted clinic offering preventive and general medical care.',
                'long' => 'Health First Clinic offers reliable medical services for individuals and families. With an emphasis on preventive care and general checkups, the clinic ensures patients receive compassionate and affordable healthcare in a professional setting.',
            ],
            2 => [
                'short' => 'Comprehensive medical services and specialist consultations.',
                'long' => 'MediCare Pro is a modern facility offering a wide range of healthcare services, from internal medicine to specialty care. Known for experienced staff and advanced diagnostics, it provides timely and effective treatments for diverse health needs.',
            ],
            3 => [
                'short' => 'A multi-specialty hospital delivering round-the-clock care.',
                'long' => 'Sunshine Hospital is a full-service medical center known for its patient-centered care, 24/7 emergency services, and specialized departments including surgery, cardiology, and pediatrics. Their mission is to heal with compassion and advanced technology.',
            ],
            4 => [
                'short' => 'Focuses on holistic wellness and preventive medicine.',
                'long' => 'Wellness Center promotes a healthy lifestyle through comprehensive wellness programs, lifestyle coaching, nutrition advice, and preventive checkups. Their integrated approach helps individuals maintain long-term physical and mental health.',
            ],
            5 => [
                'short' => 'Group practice delivering personalized healthcare services.',
                'long' => 'Vitality Medical Group consists of experienced physicians offering patient-focused primary care and specialty services. From chronic illness management to wellness exams, they emphasize quality, continuity, and accessibility.',
            ],
            6 => [
                'short' => 'Neighborhood clinic offering family healthcare services.',
                'long' => 'CarePlus Clinic provides reliable healthcare in a friendly setting, ideal for families and individuals of all ages. Services include routine checkups, vaccinations, minor procedures, and chronic disease management.',
            ],
            7 => [
                'short' => 'Advanced diagnostics and medical innovations center.',
                'long' => 'Advanced Medical Solutions combines technology and expertise to deliver cutting-edge diagnostic services, personalized treatment plans, and minimally invasive procedures for complex health conditions.',
            ],
            8 => [
                'short' => 'Integrated healthcare network focused on quality and access.',
                'long' => 'Prime Healthcare operates with a vision of delivering consistent, high-quality care. With multiple departments, specialists, and urgent care facilities, they ensure patients receive timely diagnosis and treatment.',
            ],
            9 => [
                'short' => 'Encouraging healthier lives through preventive care and education.',
                'long' => 'Healthy Life Medical Center provides general medicine, wellness education, and screening programs to improve long-term health outcomes. It encourages healthy habits and regular health assessments for all age groups.',
            ],
            10 => [
                'short' => 'Professional network of expert physicians and surgeons.',
                'long' => 'MedCare Professionals is a group of experienced healthcare providers offering services in surgery, internal medicine, and diagnostic imaging. Their focus is delivering clinical excellence with compassion and efficiency.',
            ],
        ];

        foreach ($descriptions as $id => $desc) {
            Organization::where('id', $id)->update([
                'short_description' => $desc['short'],
                'long_description' => $desc['long'],
            ]);
        }
    }
}
