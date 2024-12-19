<?php

namespace App\Models\Student;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $connection = 'sqlsrv_main';
    protected $table = 'dbo.STUDENT_PAYMENT';
    protected $primaryKey = 'ReceiptNo';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'INDENTITY',
        'ReceiptNo',
        'AcademicYear',
        'ID', // Student ID
        'DYS',
        'FeeType',
        'Amount',
        'Discount',
        'AmountInWord',
        'Note',
        'Semester',
        'scholarship',
        'LatePayment',
        'Surcharge',
        'ReceivedBy',
        'ReceivedDate',
        'Location',
        'Status',
        'PostedBy',
        'PostedDate',
        'ModifiedBy',
        'ModifiedDate',
        'Editable',
    ];

    protected $casts = [
        'Amount' => 'float',
        'ReceivedDate' => 'datetime',
    ];

    public function ID(): Attribute
    {
        // set student id to uppercase
        return Attribute::make(
            get: fn(string $value) => strtoupper($value),
            set: fn(string $value) => strtoupper($value)
        );
    }
}
