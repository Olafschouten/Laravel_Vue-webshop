<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'fullName',
        'streetHouseNumber',
        'zip',
        'email',
        'id',
        'user_id',
        'created_at',
        'updated_at',
        'cart',
    ];
    /**
     * @var mixed|string
     */
    private $cart;
    /**
     * @var mixed|string
     */
    private $user_id;
    /**
     * @var mixed|string
     */
    private $streetHouseNumber;
    /**
     * @var mixed|string
     */
    private $fullName;
    /**
     * @var mixed|string
     */
    private $zip;
    /**
     * @var mixed|string
     */
    private $email;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
