<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->string('Surename');
            $table->string('GivenName');
            $table->string('NameOfStudent');
            $table->string('DateOfBirth');
            $table->string('Nationality');
            $table->string('College');
            $table->string('FieldOfStudy');
            $table->string('Degree');
            $table->string('Major');
            // $table->string('DateOfAdmission');
            // $table->string('StateExam');
            // $table->string('ResearchStudy');
            $table->string('NameInKhmer');
            $table->string('Sex');
            $table->string('POB_Province');
            $table->string('POB_District');
            $table->string('POB_Commune');
            $table->string('POB_Village');
            $table->string('Race');
            // $table->string('MaritalStatus');
            $table->string('CurrentAddress_Province');
            $table->string('CurrentAddress_District');
            $table->string('CurrentAddress_Commune');
            $table->string('CurrentAddress_Village');
            $table->string('CurrentAddress_House');
            $table->string('CurrentAddress_Street');
            $table->string('Phone');
            $table->string('Email');
            // $table->string('Photo');
            // $table->string('SSID');
            // $table->string('PassportNumber');
            // $table->string('TemporaryCertificate');
            // $table->string('HighSchoolCertificate');
            // $table->string('OtherCertificate');
            // $table->string('NoteOfCertificate');
            // $table->string('HighSchoolCertificateNo');
            $table->string('Subject1');
            $table->string('Grade1');
            $table->string('Subject2');
            $table->string('Grade2');
            $table->string('Subject3');
            $table->string('Grade3');
            $table->string('GRADE');
            $table->string('SCORE');
            // $table->string('HighSchool');
            // $table->string('High_CityProvince');
            // $table->string('High_YearOfGraduation');
            // $table->string('SecondarySchool');
            // $table->string('Secondary_CityProvince');
            // $table->string('Secondary_YearOfGraduation');
            // $table->string('PrimarySchool');
            // $table->string('Primary_CityProvince');
            // $table->string('Primary_YearOfGraduation');
            // $table->string('TechnicalSchool');
            // $table->string('Technical_CityProvince');
            // $table->string('Technical_YearOfGraduation');
            // $table->string('Khmer');
            // $table->string('KhmerWriting');
            // $table->string('KhmerListening');
            // $table->string('KhmerSpeaking');
            // $table->string('English');
            // $table->string('EnglishWriting');
            // $table->string('EnglishListening');
            // $table->string('EnglishSpeaking');
            // $table->string('OtherLanguage');
            // $table->string('OtherWriting');
            // $table->string('OtherListening');
            // $table->string('OtherSpeaking');
            // $table->string('OtherSkills');
            // $table->string('Sports');
            // $table->string('Hobbies');
            // $table->string('EmergencyName');
            // $table->string('EmergencyAddress_Province');
            // $table->string('EmergencyAddress_District');
            // $table->string('EmergencyAddress_Commune');
            // $table->string('EmergencyAddress_Village');
            // $table->string('EmergencyAddress_Street_House');
            // $table->string('EmergencyPhone');
            // $table->string('EmergencyEmail');
            // $table->string('FathersName');
            // $table->string('FathersNameKH');
            // $table->string('FathersDOB');
            // $table->string('FathersNationality');
            // $table->string('FathersRace');
            // $table->string('FathersAliveDeceased');
            // $table->string('FathersJobAndOfficeAddress');
            // $table->string('FathersJobAndOfficeAddressKH');
            // $table->string('FathersAddress');
            // $table->string('MothersName');
            // $table->string('MothersNameKH');
            // $table->string('MothersDOB');
            // $table->string('MothersNationality');
            // $table->string('MothersRace');
            // $table->string('MothersAliveDeceased');
            // $table->string('MothersJobAndOfficeAddress');
            // $table->string('MothersJobAndOfficeAddressKH');
            // $table->string('MothersAddress');
            // $table->string('TransferredFrom');
            // $table->string('ModifiedBy');
            // $table->string('ModifiedDate');
            // $table->string('Temporary_Certificate');
            // $table->string('HighSchool_Certificate');
            // $table->string('Other_Certificate');
            // $table->string('CurrentAddress_House_KH');
            // $table->string('CurrentAddress_Street_KH');
            // $table->string('Number_Of_IDCard_Printed');
            // $table->string('Transfered');
            // $table->string('AY');
            // $table->string('TransferToYear');
            // $table->string('Old_Student');
            // $table->string('User_Name');
            // $table->string('Action');
            // $table->string('Session');
            // $table->string('OnlinePay');
            // $table->string('StudyModel');
            // $table->string('ApplyScholarship');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student');
    }
};