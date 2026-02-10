<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Transaccion
 * @package App\Models
 * @version May 13, 2025, 3:46 pm -05
 *
 * @property string $amountInCents
 * @property string $createdAt
 * @property string $currency
 * @property string $customerData_fullName
 * @property string $customerData_phoneNumber
 * @property string $customerEmail
 * @property string $id_transaction
 * @property string $paymentMethod_extra_brand
 * @property string $paymentMethod_extra_externalIdentifier
 * @property string $paymentMethod_extra_lastFour
 * @property string $paymentMethod_extra_name
 * @property string $paymentMethod_installments
 * @property string $paymentMethod_type
 * @property string $reference
 * @property string $status
 */
class Transaccion extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'wompi';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'amountInCents',
        'createdAt',
        'currency',
        'customerData_fullName',
        'customerData_phoneNumber',
        'customerEmail',
        'id_transaction',
        'paymentMethod_extra_brand',
        'paymentMethod_extra_externalIdentifier',
        'paymentMethod_extra_lastFour',
        'paymentMethod_extra_name',
        'paymentMethod_installments',
        'paymentMethod_type',
        'reference',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'amountInCents' => 'string',
        'createdAt' => 'string',
        'currency' => 'string',
        'customerData_fullName' => 'string',
        'customerData_phoneNumber' => 'string',
        'customerEmail' => 'string',
        'id_transaction' => 'string',
        'paymentMethod_extra_brand' => 'string',
        'paymentMethod_extra_externalIdentifier' => 'string',
        'paymentMethod_extra_lastFour' => 'string',
        'paymentMethod_extra_name' => 'string',
        'paymentMethod_installments' => 'string',
        'paymentMethod_type' => 'string',
        'reference' => 'string',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'amountInCents' => 'nullable|string|max:255',
        'createdAt' => 'nullable|string|max:255',
        'currency' => 'nullable|string|max:255',
        'customerData_fullName' => 'nullable|string|max:255',
        'customerData_phoneNumber' => 'nullable|string|max:255',
        'customerEmail' => 'nullable|string|max:255',
        'id_transaction' => 'nullable|string|max:255',
        'paymentMethod_extra_brand' => 'nullable|string|max:255',
        'paymentMethod_extra_externalIdentifier' => 'nullable|string|max:255',
        'paymentMethod_extra_lastFour' => 'nullable|string|max:255',
        'paymentMethod_extra_name' => 'nullable|string|max:255',
        'paymentMethod_installments' => 'nullable|string|max:255',
        'paymentMethod_type' => 'nullable|string|max:255',
        'reference' => 'nullable|string|max:200',
        'status' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    
}
