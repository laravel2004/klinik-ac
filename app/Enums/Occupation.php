<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum Occupation: string implements HasLabel
{
    case STUDENT = 'student';
    case COLLEGE_STUDENT = 'college_student';
    case CIVIL_SERVANT = 'civil_servant';
    case MILITARY = 'military';
    case POLICE_OFFICER = 'police_officer';
    case PRIVATE_EMPLOYEE = 'private_employee';
    case ENTREPRENEUR = 'entrepreneur';
    case FARMER = 'farmer';
    case FISHERMAN = 'fisherman';
    case LABORER = 'laborer';
    case TEACHER = 'teacher';
    case LECTURER = 'lecturer';
    case DOCTOR = 'doctor';
    case NURSE = 'nurse';
    case HOUSEWIFE = 'housewife';
    case UNEMPLOYED = 'unemployed';
    case OTHER = 'other';

    public function getLabel(): string
    {
        return match($this) {
            self::STUDENT => __('label.student'),
            self::COLLEGE_STUDENT => __('label.college_student'),
            self::CIVIL_SERVANT => __('label.civil_servant'),
            self::MILITARY => __('label.military'),
            self::POLICE_OFFICER => __('label.police_officer'),
            self::PRIVATE_EMPLOYEE => __('label.private_employee'),
            self::ENTREPRENEUR => __('label.entrepreneur'),
            self::FARMER => __('label.farmer'),
            self::FISHERMAN => __('label.fisherman'),
            self::LABORER => __('label.laborer'),
            self::TEACHER => __('label.teacher'),
            self::LECTURER => __('label.lecturer'),
            self::DOCTOR => __('label.doctor'),
            self::NURSE => __('label.nurse'),
            self::HOUSEWIFE => __('label.housewife'),
            self::UNEMPLOYED => __('label.unemployed'),
            self::OTHER => __('label.other'),
        };
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn(self $case) => [$case->value => $case->getLabel()])
            ->toArray();
    }
}
