<?php

namespace App\Models\Student;

use App\Models\Schedule\Student as ScheduleStudent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends ScheduleStudent
{
    use HasFactory;


    protected $fillable = [
        'Surname',
        'GivenNames',
        'NameOfStudent',
        'ID',
        'DateOfBirth',
        'Nationality',
        'College',
        'FieldOfStudy',
        'Degree',
        'Major',
        'DateOfAdmission',
        'StateExam',
        'ResearchStudy',
        'NameInKhmer',
        'Sex',
        'POB_Province',
        'POB_District',
        'POB_Commune',
        'POB_Village',
        'Race',
        'MaritalStatus',
        'CurrentAddress_Province',
        'CurrentAddress_District',
        'CurrentAddress_Commune',
        'CurrentAddress_Village',
        'CurrentAddress_House',
        'CurrentAddress_Street',
        'Phone',
        'Email',
        'Photo',
        'SSID',
        'PassportNumber',
        'TemporaryCertificate',
        'HighSchoolCertificate',
        'OtherCertificate',
        'NoteOfCertificate',
        'HighSchoolCertificateNo',
        'Subject1',
        'Grade1',
        'Subject2',
        'Grade2',
        'Subject3',
        'Grade3',
        'GRADE',
        'SCORE',
        'HighSchool',
        'High_CityProvince',
        'High_YearOfGraduation',
        'SecondarySchool',
        'Secondary_CityProvince',
        'Secondary_YearOfGraduation',
        'PrimarySchool',
        'Primary_CityProvince',
        'Primary_YearOfGraduation',
        'TechnicalSchool',
        'Technical_CityProvince',
        'Technical_YearOfGraduation',
        'Khmer',
        'KhmerWriting',
        'KhmerListening',
        'KhmerSpeaking',
        'English',
        'EnglishWriting',
        'EnglishListening',
        'EnglishSpeaking',
        'OtherLanguage',
        'OtherWriting',
        'OtherListening',
        'OtherSpeaking',
        'OtherSkills',
        'Sports',
        'Hobbies',
        'EmergencyName',
        'EmergencyAddress_Province',
        'EmergencyAddress_District',
        'EmergencyAddress_Commune',
        'EmergencyAddress_Village',
        'EmergencyAddress_Street_House',
        'EmergencyPhone',
        'EmergencyEmail',
        'FathersName',
        'FathersNameKH',
        'FathersDOB',
        'FathersNationality',
        'FathersRace',
        'FathersAliveDeceased',
        'FathersJobAndOfficeAddress',
        'FathersJobAndOfficeAddressKH',
        'FathersAddress',
        'MothersName',
        'MothersNameKH',
        'MothersDOB',
        'MothersNationality',
        'MothersRace',
        'MothersAliveDeceased',
        'MothersJobAndOfficeAddress',
        'MothersJobAndOfficeAddressKH',
        'MothersAddress',
        'TransferredFrom',
        'ModifiedBy',
        'ModifiedDate',
        'Temporary_Certificate',
        'HighSchool_Certificate',
        'Other_Certificate',
        'CurrentAddress_House_KH',
        'CurrentAddress_Street_KH',
        'number_of_IDCard_Printed',
        'Transfered',
        'AY',
        'TransferToYear',
        'Old_Student',
        'User_Name',
        'Action',
        'Session',
        'OnlinePay',
        'StudyModel',
        'ComputerName',
        'ComputerIP',
        'applyScholarship',
        'NoCertificate',
    ];

    protected $appends = [
        'profile_photo'
    ];


    public function profilePhoto(): Attribute
    {
        return Attribute::make(
            get: function () {
                return route('student.profile', $this->ID);
            }
        );
    }


    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'ID', 'ID');
    }

    public function ID(): Attribute
    {
        // set student id to uppercase
        return Attribute::make(
            get: fn(string $value) => strtoupper($value),
            set: fn(string $value) => strtoupper($value)
        );
    }
    //
    // Full Name
    // Khmer Name
    // Sex	Male
    // Date of Birth
    // Place of Birth
    // Current Address
    // Grade
    // Batch	13
    // Personal Phone	0887654327

    public function scopeInfo($query)
    {
        return $query->select([
            'ID',
            'NameOfStudent',
            'NameInKhmer',
            'DateOfBirth',
            'Sex',
            'Phone',
            'GRADE',
            'CurrentAddress_Province',
            'CurrentAddress_District',
            'CurrentAddress_Commune',
            'CurrentAddress_Village',
            'CurrentAddress_House',
            'CurrentAddress_Street',
            'POB_Province',
            'POB_District',
            'POB_Commune',
            'POB_Village',
            'FathersName',
            'MothersName',
        ]);
    }



    // public function address(): Attribute
    // {
    //     return Attribute::make(
    //         get: function () {
    //             return [
    //                 'current' => [
    //                     'province' => $this->CurrentAddress_Province,
    //                     'district' => $this->CurrentAddress_District,
    //                     'commune' => $this->CurrentAddress_Commune,
    //                     'village' => $this->CurrentAddress_Village,
    //                     'house' => $this->CurrentAddress_House,
    //                     'street' => $this->CurrentAddress_Street,
    //                 ],
    //                 'birth' => [
    //                     'province' => $this->POB_Province,
    //                     'district' => $this->POB_District,
    //                     'commune' => $this->POB_Commune,
    //                     'village' => $this->POB_Village,
    //                 ]

    //             ];
    //         }
    //     );
    // }
}
